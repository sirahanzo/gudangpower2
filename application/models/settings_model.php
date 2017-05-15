<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created 4:13 PM 10/14/2016, Author Hardianto Haris.
 */


/**
 * Class Settings_Model
 * @property Model_Name $model_name
 */
class Settings_Model extends CI_Model {


    public function getNetwork()
    {
        $this->db->select('*');
        $this->db->from('network');

        return $this->db->get()->row();
    }


    public function saveNetwork($data)
    {
        $this->db->update('network', $data);
    }



    //float charge voltage
    public function getParameterSetting1()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 401);

        return $this->db->get()->result();
    }


    //temp compensation enable
    public function getParameterSetting2()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 402);

        return $this->db->get()->result();
    }


    //temp compensation coefisien
    public function getParameterSetting3()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where_in('id', [403,483]);

        return $this->db->get()->result();
    }


    //periodic equal charge
    public function getParameterSetting4()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 404);

        return $this->db->get()->result();
    }


    //periodical equal charge interval
    public function getParameterSetting5()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 405);
        $this->db->where('id <=', 406);

        return $this->db->get()->result();
    }


    //batttery test enable
    public function getParameterSetting6()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 407);

        return $this->db->get()->result();
    }


    //battery test start voltage
    public function getParameterSetting7()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 408);


        return $this->db->get()->result();
    }


    //auto battery test
    public function getParameterSetting8()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 409);


        return $this->db->get()->result();
    }


    //battery test interval (x1)
    public function getParameterSetting9c()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        //$this->db->where('id >=', 410);
        //$this->db->where('id <=', 418);
        $this->db->where_in('id',410);

        return $this->db->get();
    }

    public function getParameterSetting9()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        //$this->db->where('id >=', 410);
        //$this->db->where('id <=', 418);
        $this->db->where_in('id',['411','415','417']);

        return $this->db->get()->result();
    }

    //(x10)
    public function getParameterSetting9a()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where_in('id',['412','413','414',]);

        return $this->db->get()->result();
    }

    //(x100)
    public function getParameterSetting9b()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where_in('id',['416','418',]);

        return $this->db->get()->result();
    }


    //lvd1 (x100)
    public function getParameterSetting10()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 419);
        $this->db->where('id <=', 422);

        return $this->db->get()->result();
    }



    //hibernation
    public function getParameterSetting11()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 423);

        return $this->db->get()->result();
    }


    //hibernation interval
    public function getParameterSetting12()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 424);

        return $this->db->get()->result();
    }

    public function getParameterSetting12a()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 425);
        $this->db->where('id <=', 426);

        return $this->db->get()->result();
    }


    //relay
    public function getParameterSetting13()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 427);
        $this->db->where('id <=', 435);

        return $this->db->get()->result();
    }


    //relay
    public function getParameterSetting13c()
    {
        $this->db->select('r.name as relay,p.*');
        $this->db->from('parameter_setting p');
        $this->db->join('relay_mapping r', 'r.id=p.value', 'left');
        $this->db->where('p.id >=', 427);
        $this->db->where('p.id <=', 436);
        //$this->db->group_by('id');

        return $this->db->get()->result();
    }


    //start battery test
    public function getParameterSetting14()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 437);

        return $this->db->get()->result();
    }


    //battery test Terminal voltage
    public function getParameterSetting15()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 438);

        return $this->db->get()->result();
    }

    //(x100)
    public function getParameterSetting15a()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 439);

        return $this->db->get()->result();
    }


    //Battery Temperature Gain
    public function getParameterSetting16()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        //$this->db->where('id >=', 440);
        //$this->db->where('id <=', 455);

        $this->db->or_where_in('id', ['440', '441', '442', '443',  '445', '452', '453', '454', '455','485','486']);

        return $this->db->get()->result();
    }

    //(x10)
    public function getParameterSetting16a()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        //$this->db->where('id >=', 440);
        //$this->db->where('id <=', 455);

        $this->db->or_where_in('id', ['444','448', '449', '450', ]);

        return $this->db->get()->result();
    }

    //(x100)
    public function getParameterSetting16b()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        //$this->db->where('id >=', 440);
        //$this->db->where('id <=', 455);

        $this->db->or_where_in('id','451');

        return $this->db->get()->result();
    }


    //Manual Equalizing Charge Enable
    public function getParameterSetting17()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 456);

        return $this->db->get()->result();
    }


    //Battery Cuurent Slope
    public function getParameterSetting18()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 457);
        $this->db->where('id <=', 459);

        return $this->db->get()->result();
    }


    //Fast Charge Enable
    public function getParameterSetting19()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 460);

        return $this->db->get()->result();
    }


    //Fast Charge Voltage Set Point
    public function getParameterSetting20()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 462);
        $this->db->where('id <=', 464);

        return $this->db->get()->result();
    }

    //(x100)
    public function getParameterSetting20a()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 461);

        return $this->db->get()->result();
    }


    //(x10)
    public function getParameterSetting21()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 465);
        $this->db->where('id <=', 468);

        return $this->db->get()->result();
    }


    //Current Limit Set Point (x10)
    public function getParameterSetting22()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 469);

        return $this->db->get()->result();
    }


    //Relay type
    public function getParameterSetting23()
    {
       /* $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id >=', 470);
        $this->db->where('id <=', 479);*/

        $this->db->select('r.name as relay,p.*');
        $this->db->from('parameter_setting p');
        $this->db->join('relay_mapping r', 'r.id=p.value', 'left');
        $this->db->where('p.id >=', 470);
        $this->db->where('p.id <=', 478);
        //$this->db->group_by('id');

        return $this->db->get()->result();
    }


    //Max number of datalog
    public function getParameterSetting24()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        /*$this->db->where('id >=', 480);
        $this->db->where('id <=', 482);*/
        $this->db->where('id',480);

        return $this->db->get()->row();
    }


    //interval
    public function getParameterSetting25()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 481);

        return $this->db->get()->row();
    }

    //max eventlog
    public function getParameterSetting26()
    {
        $this->db->select('*');
        $this->db->from('parameter_setting');
        $this->db->where('id', 482);

        return $this->db->get()->row();
    }


    public function save_controll($records)
    {
        $errors = [];
        foreach ($records as $id => $values):
            $this->db->where('id', $id)->update('parameter_setting', $values) or $errors[] = $id;
        endforeach;

        return $errors;
    }


    public function getRellayMapping()
    {
        $this->db->select('*');
        $this->db->from('relay_mapping');
        //$this->db->limit(2);

        return $this->db->get()->result();
    }


    public function save_log($id, $data)
    {
        $this->db->where($id);
        $this->db->update('parameter_setting', $data);

    }

}


/* End of file Settings_Model  */
/* Location: ./application/models/Settings_Model .php */
