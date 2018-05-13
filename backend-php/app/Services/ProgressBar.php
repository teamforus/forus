<?php
namespace App\Services;

class ProgressBar
{
    protected $char;
    protected $progress;
    protected $progress_bar;
    
    protected $print_bar;
    protected $print_text;
    protected $c_width;
    
    function __construct(
        $char = '=', 
        $print_bar = true, 
        $print_text = true
        ) {
        $this->char = $char;
        $this->c_width = false;
        $this->print_bar = $print_bar;
        $this->print_text = $print_text;
    }

    public function setWidth($width = false)
    {
        $this->c_width = $width;
        return $this;
    }
    
    public function setPrintText($print)
    {
        $this->print_text = $print_text;
        return $this;
    }
    
    public function setPrintBar($print)
    {
        $this->print_bar = $print_bar;
        return $this;
    }
    
    public function setProgress($progress)
    {
        $this->progress = $progress; 
        $this->progress_bar = ($this->getWidth(-4) * ($this->progress / 100)); 
        
        return $this;
    }
    
    public function printProgress($clear = true)
    {       
        if ($clear)
            $this->clearBar();
        
        if ($this->print_bar)
            $this->printProgressBar(false);
        
        if ($this->print_text)
            $this->printProgressText(false);
        
        return $this;
    }
    
    public function printProgressBar()
    {   
        $filled = str_repeat($this->char, $this->progress_bar);
        $empty = str_repeat(' ', ($this->getWidth(-4) - strlen($filled)));

        echo "[ " . $filled . $empty . " ]";
        
        return $this;
    }
    
    public function printProgressText($str = false)
    {
        $str = $str ?: 'Progress: ' . number_format($this->progress, 0) . '/100%';
        $empty_half = ($this->getWidth() - strlen($str)) / 2;

        echo str_repeat(' ', floor($empty_half));
        echo $str;
        echo str_repeat(' ', ceil($empty_half));
        echo "\n";

        return $this;
    }
    
    public function getWidth($pads = 0)
    {
        if ($this->c_width === false)
            return intval(exec('tput cols')) + $pads;

        return $this->c_width + $pads;
    }
    
    public function clearRows($count_rows)
    {
        while($count_rows-- > 0) {
            echo "\r";
            echo "\x1b[A";
            echo str_repeat(' ', $this->getWidth());
            echo "\n";
            echo "\x1b[A";
        }
    }
    
    public function clearBar()
    {
        $rows_to_clear = 0;
        
        if ($this->print_bar)
            $rows_to_clear++;
        
        if ($this->print_text)
            $rows_to_clear++;
            
        $this->clearRows($rows_to_clear);
    }
}