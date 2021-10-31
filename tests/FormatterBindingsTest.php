<?php

namespace MichaelRubel\Formatters\Tests;

use MichaelRubel\Formatters\Exceptions\ShouldNotUseCamelCaseException;
use MichaelRubel\Formatters\FormatterServiceProvider;

class FormatterBindingsTest extends TestCase
{
    /** @test */
    public function testStringBindingsWorksProperly()
    {
        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format('date_time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);

        $result = format('table_column', 'created_at');
        $this->assertEquals('Created at', $result);
    }

    /** @test */
    public function testStringBindingsWithSetKebabCase()
    {
        config(['formatters.bindings_case' => 'kebab']);

        app()->register(FormatterServiceProvider::class, true);

        $result = format('date', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30', $result);

        $result = format('date-time', '2021-10-30 17:00:00');
        $this->assertEquals('2021-10-30 17:00', $result);

        $result = format('table-column', 'created_at');
        $this->assertEquals('Created at', $result);
    }

    /** @test */
    public function testStringBindingsWithCamelCaseIsForbidden()
    {
        $this->expectException(ShouldNotUseCamelCaseException::class);

        config(['formatters.bindings_case' => 'camel']);

        app()->register(FormatterServiceProvider::class, true);

        format('datetime', '2021-10-30 17:00:00');
    }
}
