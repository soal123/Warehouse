<?php

namespace warehouse;

use warehouse\Db;

class Validator
{
    
    protected $errors = [];
    protected $rules_list = ['required','min','max','email','exists_in_DB','numeric','aboveZero'];
    protected $messages = [
            'required' => 'The :fieldname: field is required',
            'min' => 'The :fieldname: field must be a minimum :rulevalue: characters',
            'max' => 'The :fieldname: field must be a maximum :rulevalue: characters',
            'email' => 'Not valid email',
            'exists_in_DB' => 'This name is not found in database',
            'numeric' => 'This is not a number',
            'aboveZero' => 'The :fieldname: field must be greater than zero'
        ];
    
    
    public function validate($data = [], $rules = [])
    {
        // d($data,'$data');
        // d($rules,'$rules');
        
        foreach ($data as $fieldname => $value)
        {
            if(in_array($fieldname,array_keys($rules)))
            {
                $this->check([
                        'fieldname' => $fieldname,
                        'value' => $value,
                        'rules' => $rules[$fieldname]
                    ]);
            }
        }
        
        return $this;
    }
    
    
    protected function check($field)
    {
        // d($field,'$field');
        foreach ($field['rules'] as $rule => $rule_value)
        {
            if (in_array($rule, $this->rules_list))
            {
                // var_dump($field['fieldname'], $rule, $rule_value);
                if (!call_user_func_array([$this,$rule],[$field['value'],$rule_value]))
                    {
                        // echo $field['fieldname'].': '.$rule.' - failed <br>';
                        $this->addError($field['fieldname'],
                            str_replace([':fieldname:',':rulevalue:'],
                                        [$field['fieldname'],$rule_value],
                                        $this->messages[$rule]));
                    }
                    else
                    {
                        // echo $field['fieldname'].': '.$rule.' - successful <br>';
                    }
            }
        }
    }
    
    
    protected function addError($fieldname,$error)
    {
        $this->errors[$fieldname][] = $error;
    }
    
    
    public function getErrors()
    {
        return $this->errors;
    }
    
    
    public function hasErrors()
    {
        return !empty($this->errors);
    }
    
    
    public function listErrors($fieldname)
    {
        $output = '';
        if (isset($this->errors[$fieldname]))
        {
            $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldname] as $error)
            {
                $output .= '<li>'.$error.'</li>';
            }
            $output .= "</ul></div>";
        }
        return $output;
    }
    
    
    protected function required($value, $rule_value)
    {
        // var_dump(__METHOD__,$value,$rule_value);
        // d(__METHOD__);
        // d($value);
        // d($rule_value);
        return !empty(trim($value));
    }
    
    
    protected function min($value, $rule_value)
    {
        // var_dump(__METHOD__,$value,$rule_value);
        // d(__METHOD__);
        // d($value);
        // d($rule_value);
        return mb_strlen($value,'UTF-8') >= $rule_value;
    }
    
    
    protected function max($value, $rule_value)
    {
        // var_dump(__METHOD__,$value,$rule_value);
        // d(__METHOD__);
        // d($value);
        // d($rule_value);
        return mb_strlen($value,'UTF-8') <= $rule_value;
    }
    
    
    protected function email($value, $rule_value)
    {
        // var_dump(__METHOD__,$value,$rule_value);
        // d(__METHOD__);
        // d($value);
        // d($rule_value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    
    
    protected function exists_in_DB($value, $rule_value)
    {
        $db_config = require CONFIG.'/config.php';
        $db = (Db::getInstance())->getConnection($db_config);

        $sql = 'SELECT COUNT(*) FROM `parity2` WHERE `not_main_title` = ?';
        $result = $db->query($sql,[$value])->find();
        if ($result["COUNT(*)"] == '0')
            {
                return false;
            }
            else
            {
                return true;
            }
    }
    
    
    protected function numeric($value, $rule_value)
    {
        return is_numeric($value);
    }
    
    
    protected function aboveZero($value, $rule_value)
    {
        return ($value > 0);
    }
    
    
    
    
    
    
    
}