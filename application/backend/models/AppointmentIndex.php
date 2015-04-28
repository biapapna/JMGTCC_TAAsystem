<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Appointment;

class AppointmentIndex extends Appointment
{
    public function search($params)
    {
        $query = Appointment::find()->where(['status'=>'']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['appointment_code'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'payment_rate' => $this->payment_rate,
            'date_created' => $this->date_created,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'appointment_code', $this->appointment_code])
            ->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_username', $this->client_username])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'visa_type', $this->visa_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'confirmed_by', $this->confirmed_by])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
