<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all users.
     *
     * @return mixed
     */
    public function all();

    /**
     * Update or create User
     *
     * @return mixed
     */
    public function createOrUpdate($request, $id = null);
    /**
     * Destory Users
     *
     * @return mixed
     */
    public function destroy($id);

    /**
     * Import Users
     *
     * @return mixed
     */
    public function import($request);

    /**
     * Update Users Profile
     *
     * @return mixed
     */
    public function updateProfile($request);

    /**
     * Update Users Profile
     *
     * @return mixed
     */
    public function updatePassword($request);

    /**
     * Update Users Profile
     *
     * @return mixed
     */
    public function userUpdatePassword($request);
}
