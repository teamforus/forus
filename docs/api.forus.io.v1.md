## api.forus.io/v1/

## Identity and records

### // Registration

````
POST /identity
    REQUEST:
        pin_code: (optional)
        type: personal/organization
        records:
            email:
            ...
    RESPONSE (PROXY_IDENTITY):
        {
            access_token: ""
        }
````

### // Logout
````
DELETE /identity/proxy
    REQUEST: {}
    RESPONSE: {}
````

### // Set pincode
````
POST /identity/pin-code
    REQUEST:
        {
            pin_code: "",
            old_pin_code: "",
        }
    RESPONSE:
        {
            success: true/false
        }
````
### // Check pincode
````
GET /identity/pin-code/53343
    REQUEST:
    RESPONSE:
        {
            match: true/false
        }
````
### // Generate new proxy (auth code)
````
POST /identity/code
    REQUEST: {}
    RESPONSE: {
        auth_code: 123456
    }
````
### // Generate new proxy (auth token)
````
POST /identity/token
    REQUEST: {}
    RESPONSE: {
        auth_token: ""
    }
````
### // Generate new proxy (auth email)
````
POST /identity/email
    REQUEST: {
        email: "",
        source: "app/webshop"
    }
    RESPONSE: {
        success: true/false
    }
````
### // Authorize given auth token
````
POST /identity/authorize/token
    REQUEST: {
        auth_token: ""
    }
    RESPONSE: {
        success: true/false
    }
````
### // Authorize given auth code
````
POST /identity/authorize/code
    REQUEST: {
        auth_code: 123456
    }
    RESPONSE: {
        success: true/false
    }
````
### // Authorize given auth email (response json/redirect)
````
GET /identity/authorize/email/459348759348573489
    REQUEST: {}
    RESPONSE: {}
````

### // Record categories
````
GET /identity/record-categories
    REQUEST: {}
    RESPONSE: [
        {
            id: 1,
            key: null,
            name: "Custom category",
            order: 0
        }
    ]
````
### // Add record category
````
POST /identity/record-categories
    REQUEST: {
        name: "",
    }
    RESPONSE: {
        success: true/false
    }
````
### // Update record category
````
PUT /identity/record-categories/1
    REQUEST: {
        name: "",
    }
    RESPONSE: {
        success: true/false
    }
````
### // Sort record categories
````
PUT /identity/record-categories/order
    REQUEST: {
        categories: [5, 1, 2, 3, 4],
    }
    RESPONSE: {
        success: true/false
    }
````
### // Get records
````
GET /identity/records
    REQUEST: {}
    RESPONSE: [
        {
            id: 1,
            key: "email",
            value: "test@example.com",
            valid: true/false,
            record_category_id,
        }
    ]
````
### // Add record
````
POST /identity/records
    REQUEST: {
        key: "",
        value: "",
        record_category_id: null,
    }
    RESPONSE: {
        success: true/false
    }
````

### // Show record
````
GET /identity/records/1
    REQUEST: {}
    RESPONSE: {
        key: "email",
        value: "test@example.com",
        valid: true/false,
        record_category_id: null,
        validation: [{

        }]
    }
````
### // Update record
````
PUT /identity/records/1
    REQUEST: {
        record_category_id: null,
    }
    RESPONSE: {
        success: true/false
    }
````
### // Delete record
````
DELETE /identity/records/1
    REQUEST: {}
    RESPONSE: {
        success: true/false
    }

````
