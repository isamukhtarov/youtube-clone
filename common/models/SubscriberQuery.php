<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Subscriber]].
 *
 * @see Subscriber
 */
class SubscriberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Subscriber[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Subscriber|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
