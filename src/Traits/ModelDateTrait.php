<?php

namespace Behzi\Basemanager\Traits;

use Behzi\Basemanager\Helper\Utility;

trait ModelDateTrait
{
    public function getCreatedAt()
    {
        return Utility::convertDate($this->created_at);
    }
    
    public function getUpdatedAt()
    {
        return Utility::convertDate($this->created_at);
    }
}
