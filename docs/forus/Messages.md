
# Example message (empty)
```javascript
{
  "event": "EventName",
  "correlationId": number, //optional
  "eventdata": {
    ... // to be defined for specific events
  }
}
```
The correlation id can be used to identify messages that where triggerd by another message, for example:

# Create identity example with response
```javascript
{
  "event": "CreateIdentity",
  "correlationId": "1234",
  "eventdata": {
    "name": "Jasper"
  }
}

{
  "event": "IdentityCreated",
  "correlationId": "1234",
  "eventdata": {
    "id": "0x..."
    "name": "Jasper"
  }
}

```
