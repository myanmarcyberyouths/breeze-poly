<?php

namespace Tests\Feature;

use function Pest\Stressless\stress;


it('has a fast response time', function () {
    $result = stress('http://breeze-poly.test');

    expect($result->requests()->duration()->med())->toBeLessThan(100); // < 100.00ms
});
