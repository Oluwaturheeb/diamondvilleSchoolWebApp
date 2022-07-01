<?php
namespace Devtee\Tlyt\Components;

class Batch extends Db {
  protected $_table = 'batch_jobs';
  
  /**
   * GetJob
   *
   * Get uncompleted from db
   *
   * @param Type $var Description
   * @return object|null
   **/
  protected function getJob () {
    return $this->get()->where(['status', '!=', 'completed'])->verbose();
  }
  
  public function addJob ($job) {
    $this->add([
      'path', 'status'
    ], [
      $job, 'new'
    ])->res();
  }
  
  protected function processJob () {
    foreach ($this->getJob() as $job) {
      if ($job->attempt != config('job/retries')) {
        echo 'runing job';
      }
    }
  }

  /**
   * SetStatus
   *
   * Set job status after worker iteration
   *
   * @param string $status Status of the job after iteration.
   * @return void
   **/
  public function setStatus(string $status) {
    
  }
  
  public function run () {
    $this->processJob();
  }
}