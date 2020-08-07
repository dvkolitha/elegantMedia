<?php
namespace App\Repositories\GuestRepositories;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface GuestTicketRepositoryInterface extends BaseRepositoryInterface
{
	public function store(array $data);
	public function createRefNumber();
	public function sendEmail($reference_number,$customerEmail);
	public function createUser(array $data);
	public function viewByAgent($id);
	public function sendReply($referenceNumber,$reply,$customerMail);
	public function sendReplyMail($reference_number,$reply,$customerMail);
}