<?php
class AppException extends Exception
{
}

class ValidationException extends AppException
{
}

class RecordNotFoundException extends AppException
{
}

class ServiceNotFoundException extends AppException
{
}

class NotEnoughMaterialsException extends AppException
{
}

class ItemExistsException extends AppException
{
}
