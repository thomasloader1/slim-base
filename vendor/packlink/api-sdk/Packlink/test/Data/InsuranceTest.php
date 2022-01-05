<?php
/**
 * Copyright 2016 OMI Europa S.L (Packlink)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Packlink;

use Packlink\Data\Insurance;

include_once __DIR__ . '/../../Data/Insurance.php';

class InsuranceTest extends \PHPUnit_Framework_TestCase
{
    public function testJSONConversion()
    {
        $obj = new Insurance();
        $ret = json_encode($obj);
        self::assertSame('{}', $ret);
    }
}
