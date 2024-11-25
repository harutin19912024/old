<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $fname
 * @property string|null $lname
 * @property string $email
 * @property string $password
 * @property int $status
 * @property string $role
 * @property string $auth_key
 * @property string|null $password_reset_token
 * @property string|null $account_activation_token
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'regular';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'status', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['role'], 'string'],
            [['username', 'fname', 'lname', 'email', 'password', 'password_reset_token', 'account_activation_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['account_activation_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'account_activation_token' => 'Account Activation Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function isAdmin()
    {
        return $this->is(self::ROLE_ADMIN);
    }

    /**
     * @param integer $role
     * @return bool
     */
    public function is($role)
    {
        return $this->role == $role;
    }

    /**
     * @param integer $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @param string $password Plain text
     * @return $this
     */
    public function setNewPassword($password)
    {
        $this->password = \Yii::$app->security->generatePasswordHash($password);
        $this->password_reset_token = null;

        return $this;
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     *
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     *
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds an identity by the given token.
     *
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}