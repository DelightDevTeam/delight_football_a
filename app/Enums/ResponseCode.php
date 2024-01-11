<?php

enum ResponseCode: string
{
    case Success = "success";

    case WrongCredential = "wrong_credential";
}
