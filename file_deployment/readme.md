# CHIF File Deployment 

## Getting Started

These docs will provide basic examples/tutorials of storing and streaming of CHIF files from 3rd party cloud providers.

## General Notes

1. If you have your own method of storing and streaming files to your website this is irrelavant.

2. Streaming files from different origin will require [CORS](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing) (Cross Origin Resource Sharing) to be turned on for your public storage location. 

3. Most providers of file storage services disallow CORS by default.

4. Use a same origin storage system if able. 

5. Otherwise use the references below.

## Navigation

* [Amazon Web Services - S3 Storage](aws.md)
* [Google Cloud Provider - Bucket Storage](gcp.md)