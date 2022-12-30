<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ApiController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');
        $this->restlibrary->responseStatus(
            false,
            REQUEST_SUCCESS,
            'api working successfully'
        );
    }

    public function addUser()
    {
        try {

            $this->restlibrary->settingUpHeaders();
            $this->restlibrary->validatingAcceptHeader('application/json');
            $inputArray = $this->restlibrary->basicFunctionForPostInputs();
            $email = $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'email');

            $whereCondtion = [
                'email' => $email
            ];

            $checkUserExist = $this->ApiModel->getCount('user_management', $whereCondtion);

            if ($checkUserExist == ZERO_COUNT) {

                $insertData = [
                    'first_name' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'firstName'),
                    'last_name' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'lastName'),
                    'email' => $email,
                    'password' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'password'),
                ];

                $insertCheck = $this->ApiModel->insertData('user_management', $insertData);
                if ($insertCheck > FAILED) {
                    $this->restlibrary->responseStatus(
                        false,
                        REQUEST_SUCCESS,
                        'User created successfully'
                    );
                } else {
                    throw new Exception("Database Error", 1);
                }
            } else {
                throw new Exception("$email User already Exist");
            }
        } catch (Exception $e) {
            $this->restlibrary->responseStatus(
                true,
                REQUEST_NOT_VALID,
                $e->getMessage()
            );
        }
    }

    public function loginUser()
    {
        try {

            $this->restlibrary->settingUpHeaders();
            $this->restlibrary->validatingAcceptHeader('application/json');
            $inputArray = $this->restlibrary->basicFunctionForPostInputs();
            $email = $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'email');
            $password = $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'password');

            $whereCondition = [
                'email' => $email,
                'password' => $password
            ];

            $response =  $this->ApiModel->getSingleRowWithWhere('*', 'user_management', $whereCondition);

            if (!empty($response)) {
                $this->restlibrary->responseStatus(
                    false,
                    REQUEST_SUCCESS,
                    $response->user_id
                );
            } else {
                throw new Exception("User not found");
            }
        } catch (Exception $e) {
            $this->restlibrary->responseStatus(
                true,
                NOT_FOUND,
                $e->getMessage()
            );
        }
    }

    public function myProfile($id)
    {
        try {

            $this->restlibrary->settingUpHeaders();
            $this->restlibrary->validatingAcceptHeader('application/json');

            $whereCondition = [
                'user_id' => $id
            ];

            $response =  $this->ApiModel->getSingleRowWithWhere('*', 'user_management', $whereCondition);

            if (!empty($response)) {
                $this->restlibrary->responseStatus(
                    false,
                    REQUEST_SUCCESS,
                    $response
                );
            } else {
                throw new Exception("User not found");
            }
        } catch (Exception $e) {
            $this->restlibrary->responseStatus(
                true,
                UNAUTHORIZED,
                $e->getMessage()
            );
        }
    }

    public function updateProfile()
    {

        try {

            $this->restlibrary->settingUpHeaders();
            $this->restlibrary->validatingAcceptHeader('application/json');
            $inputArray = $this->restlibrary->basicFunctionForPostInputs();
            $id = $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'id');

            $whereCondtion = [
                'user_id' => $id
            ];

            $updateData = [
                'first_name' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'firstName'),
                'last_name' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'lastName'),
                'email' => $this->restlibrary->inPutValidationErrorAndFiltteringData($inputArray, 'email')
            ];

            $insertCheck = $this->ApiModel->updateData('user_management', $whereCondtion, $updateData);
            if ($insertCheck > FAILED) {
                $this->restlibrary->responseStatus(
                    false,
                    REQUEST_SUCCESS,
                    'User updated successfully'
                );
            } else {
                throw new Exception("Database Error", 1);
            }
        } catch (Exception $e) {
            $this->restlibrary->responseStatus(
                true,
                UNAUTHORIZED,
                $e->getMessage()
            );
        }
    }
    public function allUsers($userId)
    {

        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');

        $data = $this->ApiModel->getDataByWhereByOrderBy('*', 'user_management', [
            'user_id !=' => $userId
        ], 'first_name', 'ASC');

        $this->restlibrary->responseStatus(
            false,
            SUCCESS,
            $data
        );
    }
    public function searchUser($userId, string $serachUser = '')
    {

        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');

        $data = [];

        if ($serachUser !== '') {
            $serachUser = urldecode($serachUser);
            $data = $this->db->select('*')->where(['user_id !=' => $userId])->like('first_name', $serachUser, 'both')->order_by('first_name', 'ASC')->get('user_management')->result();
        }

        $this->restlibrary->responseStatus(
            true,
            SUCCESS,
            $data
        );
    }

    public function createPost()
    {
        try {
            $this->restlibrary->settingUpHeaders();
            $this->restlibrary->validatingAcceptHeader('application/json');
            
            if (!empty($_FILES['postImage']['name'])) {
                $imageName = uploadSingleFile($_FILES['postImage'], UPLOAD_EXCEL_PATH);
                $check = $this->ApiModel->insertData('post_table', [
                    'image' => $imageName,
                    'created_by' => $_POST['created_by']
                ]);
            } else if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                $check = $this->ApiModel->insertData('post_table', [
                    'comment' => $_POST['comment'],
                    'created_by' => $_POST['created_by']
                ]);
            }

            if ($check) {
                $this->restlibrary->responseStatus(
                    false,
                    REQUEST_SUCCESS,
                    'Post created successfully'
                );
            } else {
                throw new Exception("Database problem", 1);
            }
        } catch (Exception $c) {
            $this->restlibrary->responseStatus(
                true,
                REQUEST_NOT_VALID,
                $c->getMessage()
            );
        }
    }

    public function getAllPostData($userId)
    {
        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');
        $allPosts = $this->db->query("SELECT u.*,p.* FROM post_table as p INNER JOIN user_management as u ON u.user_id = p.created_by ORDER BY id DESC")->result();

        $allLikeUnlike  = $this->ApiModel->getDataByWhereByOrderBy('*', 'like_post', [
            'user_id' => $userId
        ], 'id', 'DESC');

        $allComments  = $this->db->query('SELECT * FROM comment_table as ct INNER JOIN user_management as u ON u.user_id=ct.created_by')->result();

        $this->restlibrary->responseStatus(
            false,
            REQUEST_SUCCESS,
            [
                'allPosts' => $allPosts,
                'allLikeUnlike' => $allLikeUnlike,
                'allComment' => $allComments
            ]
        );
    }

    public function likeCommentPost()
    {
        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');

        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        $check = $this->ApiModel->getSingleRowWithWhere('*', 'like_post', [
            'post_table_id' => $post_id,
            'user_id' => $user_id
        ]);

        if ($check) {
            $this->ApiModel->deleteData('like_post', ['id' => $check->id]);
        } else {
            $insertData = [
                'post_table_id' => $post_id,
                'user_id' => $user_id
            ];
            $this->ApiModel->insertData('like_post', $insertData);
        }

        $this->restlibrary->responseStatus(
            false,
            REQUEST_SUCCESS,
            'program executed'
        );
    }

    public function postCommentComment() {
        $this->restlibrary->settingUpHeaders();
        $this->restlibrary->validatingAcceptHeader('application/json');
        $insertData = [
            'comment' => $_POST['comment_comment'],
            'post_table_id' => $_POST['post_id_comment'],
            'created_by' => $_POST['created_by_comment']
        ];
        $this->ApiModel->insertData('comment_table', $insertData);
        
        $this->restlibrary->responseStatus(
            false,
            REQUEST_SUCCESS,
            'program executed'
        );
    }

    // public function token()
    // {
    //     echo "<pre>";
    //     $token = $jwt->decode($token, $jwtSecretKey);
    //     print_r($token);
    // }
}
