<?php
class TasksController extends AppController{
  public $scaffold;
  public $uses = array('Task');
  
  public function index(){
    $this->set('tasks', $this->Task->find('all'));

  }
   public function add() {
        if ($this->request->is('post')) {
            $this->Task->create();
            if ($this->Task->save($this->request->data)) {
                $this->Flash->success(__('The Task has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The Task could not be saved. Please, try again.')
            );
  

      }
    }}
