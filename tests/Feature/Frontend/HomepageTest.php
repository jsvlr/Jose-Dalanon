<?php

describe('homepage', function () {

    it('has homepage page', function () {
        $response = $this->get('/');

        $response->assertStatus(200);
    });
});
