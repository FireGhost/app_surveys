<?php
    
class UniqueChoiceQuestion extends Question
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
    
    public function saveAnswer($propositionId, $participation, $userInputs=null)
    {
        
        $date = new DateTime();
        
        
        // Retriving existing answer
        $criteria = new CDbCriteria;
        $criteria->addCondition('participation_id=:participation_id');
        $criteria->addCondition('proposition_id=:prop_id');
        $criteria->params = array(':participation_id' => $participation->id, ':prop_id' => $propositionId);
        
        // Modifying answer or create new one
        if (! ($answeredProposition = AnsweredProposition::model()->find($criteria)) ) {
            $answeredProposition = new AnsweredProposition;
            $answeredProposition->created_at = $date->format('Y-m-d H:i:s');
        }
        
        
        $answeredProposition->proposition_id = $propositionId;
        $answeredProposition->participation_id = $participation->id;
        $answeredProposition->body = ( isset($userInputs[$propositionId]) ? $userInputs[$propositionId] : null);
        
        $answeredProposition->updated_at = $date->format('Y-m-d H:i:s');
        
        // Save the answer
        if (! $answeredProposition->save() )
            return false;
        
        
        return true;
    }
}
