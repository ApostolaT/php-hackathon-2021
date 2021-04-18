<?php


namespace App\Service;


use App\Entity\Room;

class RoomGetGetService extends AbstractGetService
{
    public function get(int $id): ?array {
        $room = $this->getManagerRegistry()
            ->getRepository(Room::class)
            ->find($id);

        //TODO catch the exception
        $room = $this->getNormalizer()->normalize($room);
        return $room;
    }
}