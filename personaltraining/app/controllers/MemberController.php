<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class MemberController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for member
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Member', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $member = Member::find($parameters);
        if (count($member) == 0) {
            $this->flash->notice("The search did not find any member");

            $this->dispatcher->forward([
                "controller" => "member",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $member,
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
     * Edits a member
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $member = Member::findFirstByid($id);
            if (!$member) {
                $this->flash->error("member was not found");

                $this->dispatcher->forward([
                    'controller' => "member",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $member->getId();

            $this->tag->setDefault("id", $member->getId());
            $this->tag->setDefault("firstname", $member->getFirstname());
            $this->tag->setDefault("surname", $member->getSurname());
            $this->tag->setDefault("membertype", $member->getMembertype());
            $this->tag->setDefault("dateofbirth", $member->getDateofbirth());
            
        }
    }

    /**
     * Creates a new member
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);

            return;
        }

        $member = new Member();
        $member->setfirstname($this->request->getPost("firstname"));
        $member->setsurname($this->request->getPost("surname"));
        $member->setmembertype($this->request->getPost("membertype"));
        $member->setdateofbirth($this->request->getPost("dateofbirth"));
        

        if (!$member->save()) {
            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("member was created successfully");

        $this->dispatcher->forward([
            'controller' => "member",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a member edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $member = Member::findFirstByid($id);

        if (!$member) {
            $this->flash->error("member does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);

            return;
        }

        $member->setfirstname($this->request->getPost("firstname"));
        $member->setsurname($this->request->getPost("surname"));
        $member->setmembertype($this->request->getPost("membertype"));
        $member->setdateofbirth($this->request->getPost("dateofbirth"));
        

        if (!$member->save()) {

            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'edit',
                'params' => [$member->getId()]
            ]);

            return;
        }

        $this->flash->success("member was updated successfully");

        $this->dispatcher->forward([
            'controller' => "member",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a member
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $member = Member::findFirstByid($id);
        if (!$member) {
            $this->flash->error("member was not found");

            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);

            return;
        }

        if (!$member->delete()) {

            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("member was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "member",
            'action' => "index"
        ]);
    }

}
