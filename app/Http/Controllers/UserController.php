<?php

namespace App\Http\Controllers;

use App\Enums\PaginationType;
use App\Http\Requests\UserRequest;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Services\CloudFileManager\S3FileManager;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends ApiController
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of users
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function index(UserRequest $request): JsonResponse
    {
        $users = $this->userRepository->all(PaginationType::LENGTH_AWARE);
        return $this->success($users, Response::HTTP_OK, [], PaginationType::LENGTH_AWARE);
    }

    /**
     * Persist a user record
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        return $this->success($user, Response::HTTP_CREATED);
    }

    /**
     * Fetch a single user's details
     *
     * @param $id
     * @return JsonResponse
     */
    public function read($id): JsonResponse
    {
        $user = $this->userRepository->read($id);
        return $this->success($user, Response::HTTP_OK);
    }

    /**
     * Update a user
     *
     * @param $id
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function update($id, UserRequest $request): JsonResponse
    {
        $user = $this->userRepository->update($id, $request->all());
        return $this->success($user, Response::HTTP_OK);
    }

    /**
     * Delete a user
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->userRepository->destroy($id);
        return $this->success($user, Response::HTTP_OK);
    }

    /**
     * Upload a profile picture for a user
     *
     * @param $id
     * @param UserRequest $request
     * @param S3FileManager $uploadService
     *
     * @return JsonResponse
     */
    public function uploadProfilePicture($id, UserRequest $request, S3FileManager $uploadService): JsonResponse
    {
        $file = $request->file('photo');
        $results = $uploadService->upload($id, $file, 'images', 'profile-pictures');
        $results = [
            'user_id' => $results['owner_id'],
            'path' => $results['path'],
            'url' => $results['url']
        ];

        $this->userRepository->update($id, ['profile_picture_path' => $results['path']]);
        return $this->success($results, Response::HTTP_OK);
    }
}
