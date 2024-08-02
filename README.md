# Project Documentation

## Overview
This document provides an overview of the "TechTest" project, including details on backend and frontend development, AWS integration, algorithm analysis, and PL/SQL implementation.

## 1. Backend Development

### Project Setup
- **Project Name**: TechTest
- **Framework**: Laravel (latest version)

### API Endpoint
- **Endpoint**: [Fetch Articles](http://ec2-18-191-103-114.us-east-2.compute.amazonaws.com/api/articles)
- **Description**: Fetches articles from the database.

### Database Migration Article Table
- **Migration File**: `2024_07_30_134221_create_articles_table.php`
- **Fields**:
    - `id`: Integer, primary key
    - `title`: String
    - `content`: Text
    - `image`: String
    - `created_at`: Timestamp

### Data Seeding
- **Seeder File**: `ArticlesTableSeeder.php`
- **Description**: Seeds the articles table with sample data.

### CRUD Operations
- **Base URL**: [CRUD Operations](http://ec2-18-191-103-114.us-east-2.compute.amazonaws.com)
    - **Create**: Adds a new article to the database.
    - **Read**: Fetches articles from the database.
    - **Update**: Modifies existing articles.
    - **Delete**: Removes articles from the database.

### Stored Procedure Implementation
- **Procedure**: `GetArticleById`
- **Migration File**: `2024_08_01_140815_create_get_article_by_id_procedure.php`
- **Usage**: Fetches an article by its ID.
- **URL**: [Get Article by ID](http://ec2-18-191-103-114.us-east-2.compute.amazonaws.com/getArticle)

## 2. Frontend Development
- **URL**: [Frontend Article Listing](http://ec2-18-191-103-114.us-east-2.compute.amazonaws.com/frontend)

### Web Page
- **Framework**: Next.js
- **Description**: Displays a list of articles fetched from the API.

### JavaScript Integration
- **Functionality**: Fetches articles from the API endpoint and displays them on the page.

### Styling
- **Preprocessors**: LESS/CSS

## 3. AWS Integration

### EC2 Configuration
- **Instance**: Configured to host the Laravel application.

### S3 Integration
- **Usage**: Stores article images.

### RDS Integration
- **Database**: MySQL used for the backend database.

## 4. Algorithm Analysis

### Fibonacci Sequence Calculation
- **Function**: Calculates the Fibonacci sequence up to a given number `n`.
- **Analysis**: Time complexity and optimization considerations.
- **URL**: [Fibonacci Analysis](http://ec2-18-191-103-114.us-east-2.compute.amazonaws.com/index.php/fibonacci)

## 5. Docker Implementation

### Setup
- **Docker**: Implemented to allow running the application on a local machine.
- **Description**: Docker configuration is included to facilitate local development and testing.

## Submission
- **Repository**: [GitHub Repository](https://github.com/muhammadrao1988/techTest)
