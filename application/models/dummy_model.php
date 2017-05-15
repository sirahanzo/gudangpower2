<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 3:22 PM 11/4/2016, Author Hardianto Haris.
 */


/**
 * Class Dummy_Model
 * @property Model_Name $model_name
 */
class Dummy_Model extends CI_Model{
    
    /**
     * Display a listing of the resource.
     *
     * @return Array Data
     */
    public function getParameter()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id >=',208);
        $this->db->where('id <=',210);
        
        return $this->db->get()->result();
    }

    public function Vac()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id >=',208);
        $this->db->where('id <=',210);

        return $this->db->get()->result();
    }

    public function busVoltage()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id',201);

        return $this->db->get()->result();
    }

    public function ibatt()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id',202);

        return $this->db->get()->result();
    }

    public function iLoad()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id',203);

        return $this->db->get()->result();
    }

    public function getParameterRelay()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        //$this->db->where_in('id',['201','202','203','204',]);
        $this->db->where('id >=',301);
        $this->db->where('id <=',310);

        return $this->db->get()->result();
    }


    public function getParameterRect()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        $this->db->where_in('id',['101','102','103']);

        return $this->db->get()->result();
    }

    public function irect()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        $this->db->where_in('id',['102']);

        return $this->db->get()->result();
    }

    public function getTemp()
    {
        $this->db->select('*');
        $this->db->from('parameter_monitoring');
        $this->db->where_in('id',['204']);

        return $this->db->get()->result();
    }

    public function getParameterAlarmRect()
    {
        $this->db->select('*');
        $this->db->from('parameter_alarm');
        $this->db->where('id >=',2);
        $this->db->where('id <=',11);

        return $this->db->get()->result();
    }

    public function getParameterAlarmAll()
    {
        $this->db->select('*');
        $this->db->from('parameter_alarm');
        $this->db->where_in('id',['01','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32',]);


        return $this->db->get()->result();
    }


    /**
     * Store/creating newly created resource in storage.
     *
     */
    public function create($data1,$data2)
    {
        $data = [
        'col1' =>  $data1,
        'col2' =>  $data2,
        ];
        
        $this->db->insert('table_name', $data);
    }   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return row
     */
    public function edit($id)
    {
        $this->db->where($id);
        $this->db->from('table_name');
        
       return $this->db->get()->result();
    }

    /**
     * Update the specified resource in storage.
     *   
     */
    public function update($id,$col1,$col2)
    {
        $data = [
        'col1' => $col1,
        'col2' => $col2
        ];
        
        $this->db->where($id);
        $this->db->update('table_name',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('table_name');
    }
}


/* End of file Dummy_Model  */
/* Location: ./application/models/Dummy_Model .php */
