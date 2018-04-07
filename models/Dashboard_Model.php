<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Dashboard_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllUsers() {
        $sql = 'SELECT * FROM users ORDER BY datecreation DESC';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            $error = new Error('There is not users');
            $error->index();
        }
    }

    public function deleteAccount($userid) {
        $errorController = ErrorController::getInstance();
        $sql = 'DELETE users,users_groups,replies,replies_score,posts FROM ((((users INNER JOIN users_groups ON users.id = users_groups.userid) LEFT JOIN replies ON users.id = replies.userid) LEFT JOIN replies_score ON users.id = replies_score.userid) LEFT JOIN posts ON users.id = posts.userid) WHERE users.id =:userid';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $check = $stmt->execute();
        if ($check === TRUE) {
            return true;
        } else {
            $errorController->addError('Error while deleting account');
            $errorController->checkErrors();
        }
    }

    public function getAllEvents() {
        $sql = 'SELECT * FROM events ORDER BY type,datecreation';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function addPost() {

        $errorController = ErrorController::getInstance();

        parse_str($_POST['formdata'], $formdata);
        $groupid = Auth_Model::safestrip($formdata['groupid']);
        $userid = Auth_Model::safestrip($formdata['userid']);
        $text = Auth_Model::safestrip($formdata['text']);
        $sql = "INSERT INTO posts (userid, groupid, text) VALUES (:userid,:groupid,:text)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':groupid', $groupid);
        $stmt->bindValue(':text', $text);
        $check = $stmt->execute();
        if ($check === TRUE) {
            $formdata['id'] = $this->db->lastInsertId();
            return $formdata;
        } else {
            $errorController->addError('Incorect email or password');
            $errorController->checkErrors();
        }
    }

    public function addEvent() {

        $errorController = ErrorController::getInstance();

        $type = Auth_Model::safestrip($_POST['type']);
        $userid = Auth_Model::safestrip($_POST['userid']);
        $text = Auth_Model::safestrip($_POST['text']);
        $sql = "INSERT INTO events (userid, type, text) VALUES (:userid,:type,:text)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':text', $text);
        $check = $stmt->execute();
        if ($check === TRUE) {
            header('location:' . BASEURL . 'dashboard/events');
        } else {
            $errorController->addError('Error while saving event');
            $errorController->checkErrors();
        }
    }

    private function notify($postid){

        $mail = new PHPMailer(true);

        $sql = 'SELECT U.email,U.firstname,U.lastname,P.text FROM users U, posts P WHERE U.id = P.userid AND P.id =:postid';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':postid', $postid);
        $stmt->execute();
        $mail_inf = $stmt->fetch(PDO::FETCH_ASSOC);
        $mail_notif = '';
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = MAILHOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAILUSER;
            $mail->Password = MAILPASS;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = MAILPORT;

            //Recipients
            $mail->setFrom(MAILFROM, FROM);
            $mail->addAddress($mail_inf['email']);     // Add a recipient
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Notification';
            $mail->Body = 'Someone replied on your post-'.$mail_inf['text'];

            $mail->send();
        } catch (Exception $e) {
            $mail_notif = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
        }
        return $mail_notif;
    }

    public function addReply() {

        $errorController = ErrorController::getInstance();

        $postid = $_POST['postid'];
        $text = Auth_Model::safestrip($_POST['text']);
        $userid = Session::get('id');
        $sql = "INSERT INTO replies (userid, postid, text) VALUES (:userid,:postid,:text)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':postid', $postid);
        $stmt->bindValue(':text', $text);
        $check = $stmt->execute();
        $replyid = $this->db->lastInsertId();
        $msg = $this->notify($postid);

        if ($check === TRUE) {
            return ['replyid' => $replyid,'msg' => $msg];
        } else {
            $errorController->addError('Error occured while saving rep');
            $errorController->checkErrors();
        }
    }

    public function addLike() {

        $errorController = ErrorController::getInstance();

        $replyid = $_POST['replyid'];
        $userid = $_POST['userid'];
        $sql = "INSERT INTO replies_score (replyid, userid) VALUES (:replyid,:userid)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':replyid', $replyid);
        $check = $stmt->execute();
        if ($check === TRUE) {

            return ['userid' => $userid, 'replyid' => $replyid];
        } else {
            $errorController->addError('Error occured while saving like');
            $errorController->checkErrors();
        }
    }

    public function removeLike() {

        $errorController = ErrorController::getInstance();

        $replyid = $_POST['replyid'];
        $userid = $_POST['userid'];
        $sql = "DELETE  FROM replies_score WHERE replyid =:replyid AND userid=:userid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':replyid', $replyid);
        $check = $stmt->execute();
        if ($check === TRUE) {

            return ['userid' => $userid, 'replyid' => $replyid];
        } else {
            $errorController->addError('Error occured while deleting like');
            $errorController->checkErrors();
        }
    }

    public function loadPosts($group) {
        $sql = 'SELECT P.id,U.firstname,U.lastname,U.avatar,P.userid,P.groupid,P.text,P.datecreation FROM posts P,users U WHERE groupid =:groupid AND U.id = P.userid ORDER BY datecreation DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':groupid', $group);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            $output = '';
            foreach ($result as $post) {
                $sql = 'SELECT S.replyid,R.id,R.text,R.userid,R.postid,R.userid,U.firstname,U.lastname,U.avatar FROM (replies R,users U) LEFT JOIN replies_score S ON S.userid =:userid AND R.userid <> :userid AND S.replyid = R.id WHERE R.postid =:postid AND U.id = R.userid ORDER BY R.datecreation';

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':postid', $post['id']);
                $stmt->bindValue(':userid', Session::get('id'));
                $stmt->execute();
                $replies = $stmt->fetchAll();
                $replies_output = '';
                foreach ($replies as $reply) {
                    $replies_output .= ' <div class="row smallmargin">
                                          </div>
                                            <div class="row">
                                                <div class="col-sm-3"><a href="' . BASEURL . 'dashboard/user/' . $reply["userid"] . '"> <img src="' . BASEURL . $reply["avatar"] . '" class="img-fluid" alt="' . $reply['firstname'] . ' ' . $reply['lastname'] . '"></a></div>
                                                
                                                <div class="col-sm-7  black-borded">' . $reply['text'] . '</div>
                                                <div class="col-sm-2 ">';
                    if (Session::get('id') != $reply['userid']) {
                        if ($reply['replyid'] == null) {
                            $replies_output .= ' <a href="#" id="like-reply-' . $reply['id'] . '" class="like-reply" liked="false" replyid="' . $reply['id'] . '"><i class="far fa-thumbs-up fa-2x "></i></a>';
                        } else {
                            $replies_output .= ' <a href="#" id="like-reply-' . $reply['id'] . '" class="like-reply" liked="true" replyid="' . $reply['id'] . '"><i class="fas fa-thumbs-up fa-2x "></i></a>';
                        }
                    }

                    $replies_output .= '  </div>
                                             </div>';
                }

                $output .= '<div class="row nopadding" id="post-container" style="width: 100%;min-height: 50%;">    
                                <div class="col-sm-2 black-borded text-info text-center" style="padding: 25px;border-bottom:none">
                                   <a href="' . BASEURL . 'dashboard/user/' . $post["userid"] . '">  <img src="' . BASEURL . $post["avatar"] . '" class="img-fluid" alt="Cinque Terre"></a>
                                    <p class="font-weight-bold"><h5 class="btn-responsive">' . $post["firstname"] . " " . $post["lastname"] . '</h5></p>
                                </div>
                                <div class="col-sm-10 black-borded" style="padding: 25px 50px; border-left:none;border-right:none;border-bottom:none">
                                    <div class="row">
                                        <div class="col-sm-7" style="word-wrap: break-word">
                                              <div class="row"><h4 >' . $post["text"] . '</h4></div>
                                        
                                                <div class="row smallmargin"> 
                                                    <div class="col-sm-9">
                                                    <textarea class="form-control reply-text-' . $post['id'] . '" placeholder="Reply...." name="text" rows="4"
                                                      id="text" style=""></textarea>
                                                     </div> 
                                                     <div class="col-sm-1"> <button postid="' . $post['id'] . '" class="forumPostButton btn btn-default reply">Reply</button></div>
                                               </div>
                                         </div>
                                         <div class="col-sm-5 col-replies-' . $post['id'] . '" style="word-wrap: break-word">' . $replies_output . '</div>
                                    </div>
                                   
                                </div>
                            </div>';
            }


            return $output;
        } else {
            return '';
        }
    }

    public function loadOtherPosts($group) {
        $sql = 'SELECT P.id,U.firstname,U.lastname,U.avatar,P.userid,P.groupid,P.text,P.datecreation FROM posts P,users U WHERE groupid =:groupid AND U.id = P.userid ORDER BY datecreation DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':groupid', $group);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            $output = '';
            foreach ($result as $post) {
                $sql = 'SELECT R.id,R.text,R.userid,R.postid,R.userid,U.firstname,U.lastname,U.avatar FROM (replies R,users U) WHERE R.postid =:postid AND U.id = R.userid ORDER BY R.datecreation';

                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':postid', $post['id']);
                $stmt->execute();
                $replies = $stmt->fetchAll();
                $replies_output = '';
                foreach ($replies as $reply) {
                    $replies_output .= ' <div class="row smallmargin">
                                          </div>
                                            <div class="row">
                                                <div class="col-sm-4"><a href="' . BASEURL . 'dashboard/user/' . $reply["userid"] . '"> <img src="' . BASEURL . $reply["avatar"] . '" class="img-fluid"  alt="' . $reply['firstname'] . ' ' . $reply['lastname'] . '"></a></div>
                                                
                                                <div class="col-sm-8  black-borded">' . $reply['text'] . '</div>
                                              
                                             </div>';
                }

                $output .= '<div class="row nopadding" id="post-container" style="width: 100%;min-height: 50%;">    
                                <div class="col-sm-3 black-borded text-info text-center" style="padding: 25px;border-bottom:none">
                                   <a href="' . BASEURL . 'dashboard/user/' . $post["userid"] . '">  <img src="' . BASEURL . $post["avatar"] . '" class="img-fluid"  alt="Cinque Terre"></a>
                                    <p class="font-weight-bold"><h5 class="btn-responsive">' . $post["firstname"] . " " . $post["lastname"] . '</h5></p>
                                </div>
                                <div class="col-sm-9 black-borded" style="padding: 25px 50px; border-left:none;border-right:none;border-bottom:none">
                                    <div class="row">
                                         <div class="col-sm-6" style="word-wrap: break-word">
                                              <div class="row"><h4 >' . $post["text"] . '</h4></div>
                                         </div>
                                         <div class="col-sm-6 col-replies-' . $post['id'] . '" style="word-wrap: break-word">' . $replies_output . '</div>
                                    </div>
                                   
                                </div>
                            </div>';
            }


            return $output;
        } else {
            return '';
        }
    }

    public function topUsers($group) {
        //$sql = 'SELECT U.* FROM users U,users_groups G WHERE U.id = G.userid AND G.groupid =:groupid ORDER BY U.score DESC';
        $sql = 'SELECT count(S.replyid) as score,U.firstname,U.lastname FROM replies_score S,users U,replies R,posts P WHERE U.id = R.userid AND R.id = S.replyid AND P.id = R.postid AND P.groupid =:groupid GROUP BY R.userid ORDER BY score DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':groupid', $group);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }

    public function getAllGroupUsers($group) {
        //$sql = 'SELECT U.* FROM users U,users_groups G WHERE U.id = G.userid AND G.groupid =:groupid ORDER BY U.score DESC';
        $sql = 'SELECT U.firstname,U.lastname,U.id FROM users U INNER JOIN users_groups G On U.id = G.userid AND G.groupid =:groupid';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':groupid', $group);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            foreach ($result as $key => $value) {
                $sql = 'SELECT count(R.id) as score FROM replies R, replies_score S WHERE R.id = S.replyid AND R.userid =:userid';
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':userid', $value['id']);
                $stmt->execute();
                $score = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($score !== FALSE) {
                    $result[$key]['score'] = $score['score'];
                } else {
                    $result[$key]['score'] = 0;
                }
            }
            return $result;
        } else {
            return [];
        }
    }

    public function updateProfile() {
        $errorController = ErrorController::getInstance();

        $id = Auth_Model::safestrip($_POST['id']);
        $description = Auth_Model::safestrip($_POST['description']);
        $year = Auth_Model::safestrip($_POST['year']);
        $campus = Auth_Model::safestrip($_POST['campus']);
        $group = Auth_Model::safestrip($_POST['group']);

        if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            $avatar_path = 'public/user_images/' . $_FILES['avatar']['name'];
            if (preg_match("!image!", $_FILES['avatar']['type'])) {
                copy($_FILES['avatar']['tmp_name'], $avatar_path);
                unlink($_POST['oldavatar']);
            } else {
                $errorController->addError('Error while uploading avatar');
            }
            $errorController->checkErrors();
        } else {
            $avatar_path = $_POST['oldavatar'];
        }


        $sql = "UPDATE users SET description=:description,year=:year,campusid=:campus,avatar=:avatar WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':year', $year);
        $stmt->bindValue(':campus', $campus);
        $stmt->bindValue(':avatar', $avatar_path);
        $check = $stmt->execute();
        if ($check === TRUE) {

            $sql = "UPDATE users_groups SET groupid=:groupid WHERE userid=:userid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':userid', $id);
            $stmt->bindValue(':groupid', $group);
            $stmt->execute();

            header('location:' . BASEURL . 'dashboard');
        } else {
            $errorController->addError('Error occured');
            $errorController->checkErrors();
        }
    }

    public function getGroups() {
        $sql = 'SELECT * FROM groups';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            $error = ErrorController::getInstance();
            $error->showError('There is no groups');
        }
    }

    public function getAllGroups() {
        $sql = 'SELECT G.name,G.id,COUNT(U.id) as members FROM groups G LEFT JOIN users_groups U ON U.groupid = G.id GROUP by G.id ORDER BY COUNT(U.id) DESC';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            $error = ErrorController::getInstance();
            $error->showError('There is no groups');
        }
    }

    public function getProfile($userid = null) {
        if ($userid == null) {
            $userid = Session::get('id');
        }


        $sql = 'SELECT U.*,G.groupid FROM users U,users_groups G WHERE U.id = G.userid AND U.id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $userid);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            $sql = 'SELECT count(S.replyid) as score FROM replies_score S,users U,replies R WHERE U.id = R.userid AND R.id = S.replyid AND U.id =:id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $userid);
            $stmt->execute();
            $result2 = $stmt->fetchAll();
            $num_rows2 = count($result2);
            if ($num_rows2 > 0) {
                $result[0]['score'] = $result2[0]['score'];
            } else {
                $result[0]['score'] = 0;
            }

            return $result[0];
        } else {
            $error = ErrorController::getInstance();
            $error->showError('There is no groups');
        }
    }

    public function getGroupInfo($groupid) {

        $sql = 'SELECT * FROM groups WHERE id =:groupid';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':groupid', $groupid);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result[0];
        } else {
            $error = ErrorController::getInstance();
            $error->showError('Group does not exist');
        }
    }

    public function getAllCampus() {
        $sql = 'SELECT * FROM campus';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            $error = ErrorController::getInstance();
            $error->showError('There is no groups');
        }
    }

}
