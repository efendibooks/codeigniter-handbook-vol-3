<?php

class Tracker_VisitsPresenter extends TrackerPresenter
{
    public $dataTableHeaders = array( 'Day', 'Visits' );

    public function display()
    {
        return $this->ci->load->view('presenters/visits', array( 'data' => $this->values() ), TRUE);
    }

    public function dataTableHeader()
    {
        return '[ \'' . implode("', '", $this->dataTableHeaders) . '\' ],';
    }

    public function dataTableData()
    {
        $dataStr = '';
        $data = $this->values();
        $dayCounts = array();

        foreach ($data as $value)
        {
            $day = date('Y-m-d', strtotime($value[0]));

            if (isset($dayCounts[$day]))
            {
                $dayCounts[$day]++;
            }
            else
            {
                $dayCounts[$day] = 1;
            }
        }

        foreach ($dayCounts as $day => $count)
        {
            $dataStr .= "[ '" . $day . "', " . $count . " ],";
        }

        return substr($dataStr, 0, strlen($dataStr) - 1);
    }
}