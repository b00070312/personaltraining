<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TrainerController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for trainer
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Trainer', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $trainer = Trainer::find($parameters);
        if (count($trainer) == 0) {
            $this->flash->notice("The search did not find any trainer");

            $this->dispatcher->forward([
                "controller" => "trainer",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $trainer,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a trainer
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $trainer = Trainer::findFirstByid($id);
            if (!$trainer) {
                $this->flash->error("trainer was not found");

                $this->dispatcher->forward([
                    'controller' => "trainer",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $trainer->getId();

            $this->tag->setDefault("id", $trainer->getId());
            $this->tag->setDefault("firstname", $trainer->getFirstname());
            $this->tag->setDefault("surname", $trainer->getSurname());
            $this->tag->setDefault("qualification", $trainer->getQualification());
            $this->tag->setDefault("speciality", $trainer->getSpeciality());
            
        }
    }

    /**
     * Creates a new trainer
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'index'
            ]);

            return;
        }

        $trainer = new Trainer();
        $trainer->setfirstname($this->request->getPost("firstname"));
        $trainer->setsurname($this->request->getPost("surname"));
        $trainer->setqualification($this->request->getPost("qualification"));
        $trainer->setspeciality($this->request->getPost("speciality"));
        

        if (!$trainer->save()) {
            foreach ($trainer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("trainer was created successfully");

        $this->dispatcher->forward([
            'controller' => "trainer",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a trainer edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $trainer = Trainer::findFirstByid($id);

        if (!$trainer) {
            $this->flash->error("trainer does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'index'
            ]);

            return;
        }

        $trainer->setfirstname($this->request->getPost("firstname"));
        $trainer->setsurname($this->request->getPost("surname"));
        $trainer->setqualification($this->request->getPost("qualification"));
        $trainer->setspeciality($this->request->getPost("speciality"));
        

        if (!$trainer->save()) {

            foreach ($trainer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'edit',
                'params' => [$trainer->getId()]
            ]);

            return;
        }

        $this->flash->success("trainer was updated successfully");

        $this->dispatcher->forward([
            'controller' => "trainer",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a trainer
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $trainer = Trainer::findFirstByid($id);
        if (!$trainer) {
            $this->flash->error("trainer was not found");

            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'index'
            ]);

            return;
        }

        if (!$trainer->delete()) {

            foreach ($trainer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "trainer",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("trainer was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "trainer",
            'action' => "index"
        ]);
    }

}
