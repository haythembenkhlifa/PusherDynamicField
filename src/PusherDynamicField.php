<?php

namespace Haythem\PusherDynamicField;

use Laravel\Nova\Fields\Field;

class PusherDynamicField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'pusher-dynamic-field';

    public function pusherId($pusherId = "")
    {
        return $this->withMeta(["pusherId" => $pusherId]);
    }
    public function pusherCluster($pusherCluster = "")
    {
        return $this->withMeta(["pusherCluster" => $pusherCluster]);
    }
    public function resourceId($resourceId = "")
    {
        return $this->withMeta(["resourceId" => $resourceId]);
    }
    public function channelName($channelName = "")
    {
        return $this->withMeta(["channelName" => $channelName]);
    }
    public function badgesMap($badgesMap = [])
    {
        return $this->withMeta(["badgesMap" => $badgesMap]);
    }
}
