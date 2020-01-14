<?php


namespace View;


use API\UserTable;
use Model\User;

class MembersView extends View {

    private $members = [];

    public function __construct($site, $user) {
        parent::__construct($site, $user);
        $this->setTitle("Members");

        if(!$this->protect($site, $user)) {
            header("location: " . $this->getProtectRedirect());
            exit;
        }

        $members = new UserTable($site);
        $members = $members->getAll();
        foreach ($members as $member) {
            array_push($this->members, new User($member));
        }
    }

    public function members() {
        $html = '<div class="members-wrapper">';
        if(!empty($this->members)) {
            foreach ($this->members as $member) {
                $id = $member->getId();
                $username = $member->getUsername();
                $firstName = $member->getFirstName();
                $lastName = $member->getLastName();
                $email = $member->getEmail();
                $phone = $member->getPhone();
                $profileImg = $member->getProfileImg();
                $role = $member->getRole();
                $joined = date("Y-m-d", $member->getJoined());

                $html .= <<<HTML
<div id="$id" class="user-card">
    <button id="$id" class="delete-user">X</button>
    <h2 class="username">$username</h2>
    <p class="profileImg"><img src="$profileImg" /></p>
    <h3 class="name">$firstName $lastName</h3>
    <p class="email">$email</p>
    <p class="phone">$phone</p>
    <p class="role">$role</p>
    <p class="joined">$joined</p>
</div>
HTML;
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function present() {
        echo $this->head();

        echo '<div id="members">';
        echo $this->nav();
        echo $this->members();
        echo '</div>';
        echo $this->footer();
    }
}