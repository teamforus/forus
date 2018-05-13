<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\IdentityAuthorizationEmailTokenRequest;
use App\Http\Requests\Api\IdentityStoreRequest;
use App\Http\Requests\Api\IdentityUpdatePinCodeRequest;
use App\Models\Source;
use App\Repositories\Interfaces\IIdentityRepo;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IRecordRepo;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    protected $identityRepo;
    protected $recordRepo;

    public function __construct(
        IIdentityRepo $identityRepo,
        IRecordRepo $recordRepo
    ) {
        $this->identityRepo = $identityRepo;
        $this->recordRepo = $recordRepo;
    }

    public function index() {
        return json_encode($this->identityRepo);
    }

    /**
     * Create new identity
     *
     * @param IdentityStoreRequest $request
     * @return array
     * @throws \Exception
     */
    public function store(IdentityStoreRequest $request)
    {
        $identityId = $this->identityRepo->make(
            $request->input('type'),
            $request->input('pin_code'),
            $request->input('records')
        );

        $identityProxyId = $this->identityRepo->makeIdentityPoxy($identityId);

        return [
            'access_token' => $this->identityRepo->getProxyAccessToken(
                $identityProxyId
            )
        ];
    }

    /**
     * @param IdentityUpdatePinCodeRequest $request
     * @return array
     * @throws \Exception
     */
    public function updatePinCode(IdentityUpdatePinCodeRequest $request)
    {
        $success = $this->identityRepo->updatePinCode(
            $request->get('proxyIdentity'),
            $request->input('pin_code'),
            $request->input('old_pin_code')
        );

        return compact('success');
    }

    /**
     * @param Request $request
     * @param string $pinCode
     * @return array
     * @throws \Exception
     */
    public function checkPinCode(Request $request, string $pinCode)
    {
        $success = $this->identityRepo->cmpPinCode(
            $request->get('proxyIdentity'),
            $pinCode
        );

        return compact('success');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function proxyDestroy(Request $request) {
        $proxyDestroy = $request->get('proxyIdentity');

        $this->identityRepo->destroyProxyIdentity($proxyDestroy);

        return response()->setStatusCode(200);
    }

    /**
     * Make new code authorization proxy identity
     * @return array
     */
    public function proxyAuthorizationCode() {
        return $this->identityRepo->makeAuthorizationCodeProxy();
    }

    /**
     * Make new token authorization proxy identity
     * @return array
     */
    public function proxyAuthorizationToken() {
        return $this->identityRepo->makeAuthorizationTokenProxy();
    }

    /**
     * Make new email authorization proxy identity
     * @param IdentityAuthorizationEmailTokenRequest $request
     * @return array
     */
    public function proxyAuthorizationEmailToken(
        IdentityAuthorizationEmailTokenRequest $request
    ) {
        $email = $request->input('email');
        $source = $request->input('source');

        $identityId = $this->recordRepo->identityIdByEmail($email);
        $proxy = $this->identityRepo->makeAuthorizationEmailProxy($identityId);

        if (!empty($proxy)) {
            $view = 'emails.identity.authorize-email_token';

            app('mail_bus')->push($view, [
                'email_token'   => $proxy['auth_email_token'],
                'source'        => $source
            ], [
                'to'            => $email,
                'subject'       => 'Restore Identity'
            ]);
        }

        return [
            'success' => !empty($proxy),
            'access_token' => !empty($proxy) ? $proxy['access_token'] : null
        ];
    }

    /**
     * Authorize code
     * @param Request $request
     * @return array|
     */
    public function proxyAuthorizeCode(Request $request) {
        $status = $this->identityRepo->activateAuthorizationCodeProxy(
            $request->get('identity'),
            $request->post('auth_code', '')
        );

        if ($status === "not-found") {
            return abort(404);
        } elseif ($status === "not-pending") {
            return abort(402, "Not pending!");
        } elseif ($status === "expired") {
            return abort(402, "Expired!");
        } elseif ($status === true) {
            return [
                'success' => true
            ];
        }

        return [
            'success' => false
        ];
    }

    /**
     * Authorize token
     * @param Request $request
     * @return array|
     */
    public function proxyAuthorizeToken(Request $request) {
        $status = $this->identityRepo->activateAuthorizationTokenProxy(
            $request->get('identity'),
            $request->post('auth_token', '')
        );

        if ($status === "not-found") {
            return abort(404);
        } elseif ($status === "not-pending") {
            return abort(402, "Not pending!");
        } elseif ($status === "expired") {
            return abort(402, "Expired!");
        } elseif ($status === true) {
            return [
                'success' => true
            ];
        }

        return [
            'success' => false
        ];
    }

    /**
     * Authorize email token
     * @param string $source
     * @param string $emailToken
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function proxyAuthorizeEmail(string $source, string $emailToken) {
        $status = $this->identityRepo->activateAuthorizationEmailProxy(
            $emailToken
        );

        if ($status === "not-found") {
            return abort(404);
        } elseif ($status === "not-pending") {
            return abort(402, "Not pending!");
        } elseif ($status === "expired") {
            return abort(402, "Expired!");
        } elseif ($status === true) {
            $source = Source::getModel()->where([
                'key' => $source
            ])->first();

            if ($source && $source->url) {
                return redirect($source->url);
            }

            return "Success!";
        }

        return "Error!";
    }
}
