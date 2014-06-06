<?php
    
class RankingQuestion extends Question
{
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Question the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function saveAnswer($propPositions, $participation, $userInputs=null)
    {
        
        $date = new DateTime();
        
        $model = AnsweredProposition::model();
        $transaction = $model->dbConnection->beginTransaction();
        
        foreach ($propPositions as $pid => $position) {
            
            // Retriving existing answer
            $criteria = new CDbCriteria;
            $criteria->addCondition('participation_id=:participation_id');
            $criteria->addCondition('proposition_id=:prop_id');
            $criteria->params = array(':participation_id' => $participation->id, ':prop_id' => $pid);
            
            // Modifying answer or create new one
            if (! ($answeredProposition = $model->find($criteria)) ) {
                $answeredProposition = new AnsweredProposition;
                $answeredProposition->created_at = $date->format('Y-m-d H:i:s');
            }
            
            
            $answeredProposition->proposition_id = $pid;
            $answeredProposition->participation_id = $participation->id;
            $answeredProposition->body = ( isset($userInputs[$pid]) ? $userInputs[$pid] : null);
            $answeredProposition->value = $position;
            
            $answeredProposition->updated_at = $date->format('Y-m-d H:i:s');
            
            // Save the answer
            if (! $answeredProposition->save() ) {
                $transaction->rollback();
                return false;
            }
            
        }
        
        $transaction->commit();
        return true;
    }
}
