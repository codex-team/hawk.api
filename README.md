# The API-Server of "uptime-monitor" project
Easy to use API to save/retrieve all data, related to monitor project.

## GraphQL API

### Create Project
```graphql
mutation CreateProject{
  project(
    id:"5a70ac62e1d8ff5cda8322a0",
  	name:"HAWK",
    url:"https://hawk.so"
  ) {
		name,
    url
	}
}
```
#### Parameters
| Parameter | Type | Description |
| -- | -- | -- |
| ID | String | Projects's unique identifier. 24-character hexadecimal string |
| name | String | Project's name |
| url | String | Project's URL |

### Retrieve all projects
```graphql
query AllProjects{
  projects {
		name,
    url
	}
}
```
