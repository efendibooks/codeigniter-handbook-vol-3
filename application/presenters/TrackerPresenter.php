<?php

class TrackerPresenter extends Presenter
{
    public function __construct($object, $name = FALSE)
    {
        parent::__construct($object, $name);
        
        $this->ci =& get_instance();
    }

    public function values()
    {
        if (!isset($this->values))
        {
            $this->ci->load->model('value_model', 'value');
            $this->values = $this->ci->value->getManyForTracker($this->tracker->id);
        }

        return $this->values;
    }
}