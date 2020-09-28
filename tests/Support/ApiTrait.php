<?php
namespace Tests\Support;

use App\User;

trait ApiTrait
{
    private $response;

    public function authenticated()
    {
        $user = factory(User::class)->create();
        $response = $this
            ->json(
                'POST',
                '/api/auth/login',
                [
                    'email' => $user->email,
                    'password' => 'not4you'
                ]
            );
        return $response;
    }

    public function assertApiResponse(Array $actualData)
    {
        $this->assertApiSuccess();

        $response = json_decode($this->response->getContent(), true);
        $responseData = $response['data'];

        $this->assertNotEmpty($responseData['id']);
        $this->assertDataKeyValue($actualData, $responseData);
    }

    public function assertApiSuccess(Array $jsonStructure = [])
    {
        $this->response->assertStatus(200);
        $this->response->assertJson(['status' => 'ok']);
        if (count($jsonStructure) > 0) $this->response->assertJsonStructure($jsonStructure);
    }

    public function assertApiFailForbidden()
    {
        $this->response->assertStatus(403);
        $this->response->assertJson([
            'status_code' => 403
        ]);
        $this->response->assertJsonStructure(['message']);
    }

    public function assertApiFailUnauthorized()
    {
        $this->response->assertStatus(401);
        $this->response->assertJson([
            'status_code' => 401
        ]);
        $this->response->assertJsonStructure(['message']);
    }

    public function assertDataKeyValue(Array $actualData, Array $expectedData)
    {
        $checkKeys = ['created_at', 'updated_at'];
        foreach (array_keys(array_diff_key($actualData, $expectedData)) as $key) {
            array_push($checkKeys, $key);
        }
        foreach ($actualData as $key => $value) {
            if (in_array($key, $checkKeys)) {
                continue;
            }
            $this->assertEquals($actualData[$key], $expectedData[$key]);
        }
    }
}
