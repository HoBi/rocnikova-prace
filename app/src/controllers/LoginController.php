<?php

/**
 * Class LoginController Takes care about login page and user's log in.
 */
class LoginController extends Controller
{
    public function processAdmin()
    {
        $userManager = new UserManager();

        if ($userManager->getUser())
        {
            $this->redirect(Url::getAlias('admin'));
        }

        $this->head['title'] = 'Přihlášení';

        if ($_POST)
        {
            try
            {
                $userManager->logIn($_POST['nickname'], $_POST['password']);
                $this->addNotice('Byl jste úspěšně přihlášen.');
                $this->redirect(Url::getAlias('admin'));
            }
            catch
            (UserError $error)
            {
                $this->addNotice($error->getMessage());
            }
        }

        $this->view = 'login';
    }
}