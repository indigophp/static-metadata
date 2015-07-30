<?php

namespace spec\Indigo\Metadata\Driver;

use Indigo\Metadata\HasMetadata;
use Metadata\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StaticDriverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Metadata\Driver\StaticDriver');
    }

    function it_is_a_metadata_driver()
    {
        $this->shouldImplement('Metadata\Driver\DriverInterface');
    }

    function it_returns_null_if_class_has_no_metadata()
    {
        $class = new \ReflectionClass('stdClass');

        $this->loadMetadataForClass($class)->shouldReturn(null);
    }

    function it_returns_metadata()
    {
        $class = new \ReflectionClass('spec\Indigo\Metadata\Driver\MetadataStub');

        $this->loadMetadataForClass($class)->shouldHaveType('Metadata\ClassMetadata');
    }

    function it_returns_the_list_of_classes()
    {
        $this->getAllClassNames()->shouldContain('spec\Indigo\Metadata\Driver\MetadataStub');
    }

    public function getMatchers()
    {
        return [
            'contain' => function($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }
}

class MetadataStub implements HasMetadata
{
    public static function getMetadata()
    {
        return new ClassMetadata(get_called_class());
    }
}
