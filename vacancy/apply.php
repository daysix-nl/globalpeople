<?php
use Carerix\Api\Rest\Entity\CRAttachment;
use Carerix\Api\Rest\Entity\CREmployee;
use Carerix\Api\Rest\Entity\CRDataNode;
use Carerix\Api\Rest\Entity\CREmployeeEducation;

    $headers = array('x-cx-pub' => $publication['publicationID']);

    $employee = new CREmployee();
    $employee->setFirstName($_POST['voornaam']);
    $employee->setLastName($_POST['achternaam']);
    $employee->setBirthDate(date('Y-m-d h:i:s', strtotime($_POST['geboortedatum'])));
    $employee->setEmailAddress($_POST['email']);
    $employee->setPhoneNumber($_POST['telefoonnummer']);

    // Education Level
    $selectedEducationLevelID = $_POST['opleidingsniveau'];
    $educationNode = CRDataNode::find((int) $selectedEducationLevelID);
    $education = new CREmployeeEducation();
    $education->setToLevel1Education1($educationNode);
    $educations[] = $education;
    $employee->setEducations($educations);

    // Function level
    $selectedFunctionLevelID = $_POST['functieniveau'];
    $functionNode = CRDataNode::find((int) $selectedFunctionLevelID);
    $employee->setToWorkLevelNode($functionNode);

    // Function 0
    $selectedFunction0ID = $_POST['function0'];
    $function0Node = CRDataNode::find((int) $selectedFunction0ID);
    $employee->setToFunction1Level1Node($function0Node);

    // GDPR
    if (isset($_POST['gdpr'])) {
        $consent_stage_node = new CRDataNode();
        $consent_stage_node->setAttributes(array('key' => 'tags', 'value' => 'ConsentGivenTag'));
        $employee->setToConsentStageNode($consent_stage_node);
        $employee->setPrivacyApprovalDate(date('Y-m-d 12:00:00', time()));
    }

    // CV
    if($upload['link'] ?? false)
    {
        $cv = file_get_contents(__DIR__ . '/../../../..' . $upload['link'], true);
        $cv = base64_encode($cv);

        $attachment = new CRAttachment(array(
            'content'  => $cv,
            'owner'    => false,
            'filePath' => $upload['id'],
            'label'    => 'Employee CV',
        ));

        $attachment->save();
        $employee->setAttachments($attachment);
    }

    // APPLY
    if($employee->apply($headers))
    {
        header('Location: '.$_SERVER['REQUEST_URI'] . '?success=1');
    }

    die('There was error trying to apply!');