<?php

namespace App\Enum;

enum LeadStatusType: string
{
    case NEW = 'new';
    case PROCESSED = 'processed';
    case REJECTED = 'rejected';
    case APPROVED = 'approved';
    case FRAUD = 'fraud';
}
