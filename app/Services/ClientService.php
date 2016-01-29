<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $client = $this->clientRepository->update($data, $id);
        $this->userRepository->update($data['user'], $client->user->id);
    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(123456);

        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }

    public function delete($id)
    {
        $client = $this->clientRepository->find($id);
        $user = $client->user;

        $client->delete();
        $user->delete();
    }
}