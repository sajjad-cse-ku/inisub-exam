<?php

namespace App;

enum MailSendStatus: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
}
