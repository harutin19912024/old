<?php
/**
 * Created by PhpStorm.
 * User: Harut
 * Date: 01.04.2020
 * Time: 14:32
 */

namespace app\components;

/**
 * Overwriting Yii Access Rules
 *
 *
 */
class AccessRule extends \yii\filters\AccessRule
{

    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
                // Check if the user is logged in, and the roles match
            } elseif (!$user->getIsGuest() && $role === $user->identity->role) {
                return true;
            }
        }

        return false;
    }
}