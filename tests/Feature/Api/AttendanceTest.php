<?php

namespace Tests\Feature\Api;

use App\Attendance;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Support\ApiTrait;

class AttendanceTest extends TestCase
{
    use ApiTrait, DatabaseTransactions;

    public function test_leave()
    {
        $authenticated = $this->authenticated();
        $attendance = factory(Attendance::class)->make([
            'user_id' => $authenticated['data']['id']
        ])->toArray();
        $this->response = $this->withHeaders(['Authorization' => 'Bearer ' . $authenticated['token']])
            ->json('POST', 'api/auth/leave', $attendance);
        $this->assertApiResponse($attendance);
    }

    public function test_user_click_start_work($token = '')
    {
        if (empty($token)) $token = $this->authenticated()['token'];
        $this->response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('POST', '/api/auth/attendance/click');
        $this->assertApiSuccess();
    }

    public function test_user_click_end_work()
    {
        $token = $this->authenticated()['token'];
        $this->test_user_click_start_work($token);
        $this->response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('PUT', '/api/auth/attendance/click/endwork');
        $this->assertApiSuccess();
    }
}
