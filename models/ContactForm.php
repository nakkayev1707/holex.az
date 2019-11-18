<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $_csrf;
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['_csrf', 'name', 'email', 'subject', 'message'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            [['phone'], 'default', 'value' => null]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'contact_form_name'),
            'email' => Yii::t('app', 'contact_form_email'),
            'phone' => Yii::t('app', 'contact_form_phone'),
            'subject' => Yii::t('app', 'contact_form_subject'),
            'message' => Yii::t('app', 'contact_form_message')
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        $user = new User();
        $userData = [
            'fio' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'ip_address' => Yii::$app->request->getUserIP(),
            'request_date' => date('Y-m-d H:i:s'),
            'title' => $this->subject,
            'text' => $this->message
        ];
        if ($user->saveUser($userData)) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->message)
                ->send();
            return true;
        }
        return false;
    }
}
