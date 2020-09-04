# CHIF Manager Usage Docs

This is the working document for the Externally Accessible API

## Navigation

-   [Getting Started](#Getting-Started)
-   [User Role Assignment](#User-Role-Assignment)

## Getting Started

These docs will provide an overview of the Manager Capabilities.

## User Role Assignment

| Role                                                                        | Owner | Admin | User        |
| --------------------------------------------------------------------------- | ----- | ----- | ----------- |
| [Create Organization ](#Create-Organization)                                | X     |       |             |
| [Manage Organization Payment Details](#Manage-Organization-Payment-Details) | X     |       |             |
| [Set Team Member Role](#Set-Team-Member-Role)                               | X     |       |             |
| [Add Team Member](#Add-Team-Member)                                         | X     | X     |             |
| [Set Team Member Activity](#Set-Team-Member-Activity)                       | X     | X     |             |
| [Remove Team Member](#Remove-Team-Member)                                   | X     | X     |             |
| [Generate API Token](#Generate-API-Token)                                   | X     | X     | X           |
| [External API](#External-API)                                               | X     | X     | X           |
| [General Organization Settings](#General-Organization-Settings)             | X     | X     | X           |
| [Builder](#Builder)                                                         | X     | X     | X           |
| [Library](#Library)                                                         | X     | X     | X           |
| [Delete A CHIF](#Delete-A-CHIF)                                             | X     |       | X (creator) |

### Create Organization

As a user of the Manager if you are not assigned to an existing organization you must create your own.
If you create an orgnaization you will be assigned the role of owner. The role of owner can only be assigned once per Organization.

### Manage Organization Payment Details

Managing payment details includes selecting subscription type, canceling/reinstate subscriptions and viewing billing history.

### Set Team Member Role

Users except the `owner` can have there member `role` change from `user` to `admin`, the role will change their capabilites.

### Add Team Member

Add team members provides the ability to add users to the organization.

### Set Team Member Activity

Activity can be set to `active` or `inactive`. If `active` the user will have access to the organization, otherwise they will not have access.

### Remove Team Member

This will remove the user from the organization.

### Generate API Token

Generate a bearer token for external api access.

### External API

Programatically access the manager api, view api [documentation](../API/readme.md) for capabilities.

### General Organization Settings

Edit general organization settings.

### Builder

Create CHIFS via the gui.

### Library

View the organization CHIF files.

### Delete A CHIF

Delete chifs created by the user who created the chif in the organization.
