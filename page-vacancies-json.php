<?php

use Carerix\Api\Rest\Entity\CRPublication;

header('Content-Type: application/json');

    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $company = explode('/', $url_path)[1] ?? false;

    if($company)
    {
        $company = strtolower($company);
    }

    $params = [];

    $filters              = [];
    $filters['sort']      = 1;
    $filters['function']  = [];
    $filters['procedure'] = [];
    $filters['city']      = [];
    $filters['search']    = $_GET['search'] ?? ''; 

    if(($_GET['sort'] ?? false) == 2)
    {
        $filters['sort'] = 2;
    }

    if($func = $_GET['function'] ?? '')
    {
        $filters['function'] = array_values(array_filter(explode(',', $func)));
    }

    if($proc = $_GET['procedure'] ?? '')
    {
        $filters['procedure'] = array_values(array_filter(explode(',', $proc)));
    }

    if($city = $_GET['city'] ?? '')
    {
        $filters['city'] = array_values(array_filter(explode(',', $city)));
    }

    $params['show']  = ['toVacancy', 'publicationEnd'];
    $params['count'] = 500;

    if($filters['sort'] == 1)
    {
        $params['ordering'] = '({key=toVacancy.modificationDate;sel=Descending})';
    }
    else
    {
        $params['ordering'] = '({key=toVacancy.modificationDate;sel=Ascending})';
    }

    $vacancies = [];
    $publications = (array) CRPublication::findAll($params);

    foreach($publications as $publication)
    {

        $push = true;

        if(strtotime($publication->publicationEnd) < microtime(true))
        {
            $push = false;
        }

        if($push)
        {
            $publication->toVacancy->publicationID = $publication->publicationID;
            array_push($vacancies, $publication->toVacancy);
        }
    }

    $data = [];

    foreach($vacancies as $vacancy)
    {
        
        $arr = [];
        $push = true;

        foreach($vacancy as $key => $value)
        {
            if(is_scalar($value))
            {
                $arr[$key] = $value;
            }
        }

        $date = date_create($arr['modificationDate']);
        $arr['modificationDate'] = date_format($date,'F d, Y');

        $arr['function'] = $vacancy->toFunctionLevel1->dataNodeID;
        $arr['procedure'] = $vacancy->toProductNode->dataNodeID;

        $arr['procedure_data'] = false;
        $arr['function_data'] = false;

        foreach($function as $val)
        {
            if($val['value'] == $arr['function'])
            {
                $arr['function_data'] = $val['label'];
            }
        }

        foreach($procedure as $val)
        {
            if($val['value'] == $arr['procedure'])
            {
                $arr['procedure_data'] = $val['label'];
            }
        }

        if(!empty($filters['function']) && !in_array($arr['function'], $filters['function']))
        {
            $push = false;
        }

        if(!empty($filters['procedure']) && !in_array($arr['procedure'], $filters['procedure']))
        {
            $push = false;
        }

        if(!empty($filters['city']) && !in_array(strtolower($arr['workCity']), $filters['city']))
        {           
            $push = false;
        }

        if(!empty($filters['search']))
        {
            $search = $arr['workPostalCode'] . $arr['jobTitle'] . $arr['workCity'] . $arr['companyInformation'];

            if(strpos(strtolower($search), strtolower($filters['search'])) === false) 
            {
                $push = false;
            }
        }

        if($arr['isHidden'] || $arr['deleted'])
        {
             
            $push = false;
        }

        if(isset($arr['endDate']))
        {
            if(strtotime($arr['endDate']) < microtime(true))
            {
                $push = false;
            }
        }

        if(isset($arr['deadline']))
        {
            if(strtotime($arr['deadline']) < microtime(true))
            {
                $push = false;
            }
        }

        if($company)
    	{
            $match1 = strtolower(preg_replace("/[^A-Za-z]/", '', $company));
            $match2 = strtolower(preg_replace("/[^A-Za-z]/", '', $arr['invoiceCompanyName']));

            if($match2 !== $match1)
            {
                $push = false;
            }
    	}
            
        if($push)
        {
            array_push($data, $arr);
        }
    }
    
    echo json_encode($data);
