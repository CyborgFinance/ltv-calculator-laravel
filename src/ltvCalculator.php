<?php

namespace Cyborgfinance\ltvCalculator;

class ltvCalculator
{

  private $value = NULL;
  private $deposit = NULL;
  private $loan = NULL;
  private $ltv = NULL;
  private $dtv = NULL;

  private $manualySet = array();

  //----------
  public function setValue($value): self
  {
      $this->value = $value;
      $this->manualySet[] = "value";
      return $this;
  }

  public function getValue(): integer
  {
      return $this->value;
  }

  //----------
  public function setDeposit($value): self
  {
      $this->deposit = round($value, 2);
      $this->manualySet[] = "deposit";
      return $this;
  }
  public function getDeposit(): integer
  {
      return $this->deposit;
  }
  //----------
  public function setLoan($value): self
  {
      $this->loan = round($value, 2);
      $this->manualySet[] = "loan";
      return $this;
  }
  public function getLoan(): integer
  {
      return $this->loan;
  }
  //----------
  public function setLtv($value): self
  {
      $this->ltv = round($value, 2);
      $this->manualySet[] = "ltv";
      return $this;
  }
  public function getLtv(): integer
  {
      return $this->ltv;
  }


  public function calcValueDeposit($value = NULL, $deposit = NULL)
  {

    if($value != NULL){$this->setValue($value);}
    if($deposit != NULL){$this->setDeposit($deposit);}

    if($this->value == 0){ abort(403, "Value not set");}
    if($this->deposit == 0){ abort(403, "Deposit not set");}

    $this->loan = $this->value-$this->deposit;
    $this->ltv = ($this->loan/$this->value)*100;
    $this->dtv = (100-$this->ltv);

    return $this->calculate(FALSE);
  }

  public function calcValueLoan($value = NULL, $loan = NULL){

    if($value != NULL){$this->setValue($value);}
    if($loan != NULL){$this->setLoan($loan);}

    if($this->value == 0){ abort(403, "Value not set");}
    if($this->loan == 0){ abort(403, "Loan not set");}

    $this->deposit = $this->value-$this->loan;
    $this->ltv = ($this->loan/$this->value)*100;
    $this->dtv = (100-$this->ltv);

    return $this->calculate(FALSE);
  }

  public function calcValueLTV($value = NULL, $ltv = NULL){

    if($value != NULL){$this->setValue($value);}
    if($ltv != NULL){$this->setLtv($ltv);}

    if($this->value == NULL){ abort(403, "Value not set");}
    if($this->ltv == NULL){ abort(403, "LTV not set");}

    $this->deposit = $this->value*($this->ltv/100);
    $this->loan = $this->value-$this->deposit;
    $this->dtv = (100-$this->ltv);

    return $this->calculate(FALSE);
  }

  public function calcLoanLTV($loan = NULL, $ltv = NULL){

    if($loan != NULL){$this->setLoan($loan);}
    if($ltv != NULL){$this->setLtv($ltv);}

    if($this->loan == NULL){ abort(403, "loan not set");}
    if($this->ltv == NULL){ abort(403, "LTV not set");}

    $this->value = ($this->loan/$this->ltv)*100;
    $this->deposit = $this->value-$this->loan;
    $this->dtv = (100-$this->ltv);

    return $this->calculate(FALSE);
  }

  public function calcDepositLTV($deposit = NULL, $ltv = NULL){

    if($deposit != NULL){$this->setDeposit($deposit);}
    if($ltv != NULL){$this->setLtv($ltv);}

    if($this->deposit == NULL){ abort(403, "deposit not set");}
    if($this->ltv == NULL){ abort(403, "LTV not set");}

    $this->dtv = (100-$this->ltv);
    $this->value = ($this->deposit/$this->dtv)*100;
    $this->loan = $this->value-$this->deposit;


    return $this->calculate(FALSE);
  }


  // This mess, detects what variables were manualy set.
  // It then automaticly runs the calculation.
  private function auto(){

    //dd($this->manualySet);

    if($this->in_array_all(["value","loan"], $this->manualySet)){
      return $this->calcValueLoan();
    }

    if($this->in_array_all(["value","deposit"], $this->manualySet)){
      return $this->calcValueDeposit();
    }

    if($this->in_array_all(["value","ltv"], $this->manualySet)){
      return $this->calcValueLTV();
    }

    if($this->in_array_all(["loan","ltv"], $this->manualySet)){
      return $this->calcLoanLTV();
    }

    if($this->in_array_all(["deposit","ltv"], $this->manualySet)){
      return $this->calcDepositLTV();
    }

    //Yolo with set variables
    if($this->value != NULL AND $this->loan != NULL){
      return $this->calcValueLoan();
    }

    if($this->value != NULL AND $this->deposit != NULL){
      return $this->calcValueDeposit();
    }

    if($this->value != NULL AND $this->ltv != NULL){
      return $this->calcValueLTV();
    }

    if($this->loan != NULL AND $this->ltv != NULL){
      return $this->calcLoanLTV();
    }

    if($this->deposit != NULL AND $this->ltv != NULL){
      return $this->calcLoanLTV();
    }

    abort(403, "Not enough data set");


  }

  private function in_array_all($needles, $haystack) {
   return empty(array_diff($needles, $haystack));
  }



  public function calculate($auto = TRUE): array{

    if($auto == TRUE){
      return $this->auto();
    }

    return [
      'value' => round($this->value, 2),
      'deposit' => round($this->deposit, 2),
      'loan' => round($this->loan, 2),
      'ltv' => round($this->ltv, 2),
      'dtv' => round($this->dtv, 2)
    ];


  }


}
