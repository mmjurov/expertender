This plugin is used to be a client for API service of Expertsender email marketing platform.

The most requests are based on XML syntax and used POST method of http protocol. To make the building of query easier this library introduces **Entities**

Entities are mirrors for XML request or response. If you wish to make query to service, you must create an instance of an Entity with specified type (if API query supports).

Every XML node - is an entity, excluding scalar values, such as strings, integers, or date.

Use object oriented interface to build entity of the required type.