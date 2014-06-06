<?php
    
class MultipleChoiceQuestion extends Question
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
    
    
    public function saveAnswer($propositionsId, $participation, $userInputs=null)
    {
        
        // Need to get all the propositions of this question
        $allPropositionsIds[0] = null;
        foreach ($this->propositions as $i=>$proposition)
            $allPropositionsIds[$i] = $proposition->id;
        
        // Start a transaction
        $model = AnsweredProposition::model();
        $transaction = $model->dbConnection->beginTransaction();
        
        
        // Get the creation date if answers for this question already exists. If it exists, delete all
        $criteria = new CDbCriteria;
        $criteria->addCondition('participation_id=:participation_id');
        $criteria->params = array(':participation_id' => $participation->id);
        $criteria->addInCondition('proposition_id', $allPropositionsIds);
        
        if ($answeredProposition = $model->find($criteria)) {
            $createdAt = new DateTime($answeredProposition->created_at);
            $model->deleteAll($criteria);
        }
        else
            $createdAt = new DateTime();

        
        $date = new DateTime();
        
        if(!empty($propositionsId))
            foreach ($propositionsId as $pid) {
                
                $answeredProposition = new AnsweredProposition;
                $answeredProposition->proposition_id = $pid;
                $answeredProposition->participation_id = $participation->id;
                $answeredProposition->body = ( isset($userInputs[$pid]) ? $userInputs[$pid] : null);
                
                $answeredProposition->updated_at = $date->format('Y-m-d H:i:s');
                $answeredProposition->created_at = $createdAt->format('Y-m-d H:i:s');
                
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
