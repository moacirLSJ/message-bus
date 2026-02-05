# Message Bus POC (Vanilla PHP)

This repository contains a **Proof of Concept (POC)** for an in-memory Message Bus implementation using pure (vanilla) PHP.

## 🎯 Goal

The primary objective of this project is to demonstrate how to implement a decoupled messaging architecture (Publish-Subscribe pattern) without relying on external frameworks or heavy libraries. It showcases how components can communicate asynchronously (in logical terms) through a central bus.

## 🏗 Architecture & Design

The project follows a **Event-Driven Architecture** principle, utilizing the following patterns:

### 1. **Message Bus (Singleton & Mediator)**
The core of the system is the `MessageBus` class.
- **Pattern**: Singleton. It ensures a single instance of the bus manages all messages and subscribers throughout the request lifecycle.
- **Role**: It acts as a Mediator, decoupling the "Publishers" (e.g., `NameChanger`) from the "Subscribers" (e.g., `Aluno`).
- **Mechanism**:
    - **Subscribe**: Listeners register callbacks for specific "topics".
    - **Publish**: Events/Messages are pushed to an internal queue.
    - **Dispatch**: The bus iterates through the queue and executes the callbacks for matching topics.

### 2. **Domain Entities as Subscribers**
The `Aluno` (Student) class is a domain entity that actively subscribes to events relevant to itself (e.g., `Aluno.update`).
- It demonstrates a pattern where the domain model reacts to events to update its own state effectively.

### 3. **Controllers / Services**
Classes like `NameChanger` act as entry points or controllers.
- They process raw input (simulated request data).
- They **publish** messages to the bus rather than modifying the domain objects directly.
- Uses **DTOs** (Data Transfer Objects) like `ChangeNameDTO` to encapsulate data moving through the bus.

### 4. **Fluent Message Interface**
The `Message` class uses a fluent interface pattern (`onTopic(...)`, `payload(...)`) for readable message construction.

## 📂 Project Structure

- `src/MessageBus.php`: The central event bus implementation.
- `src/Message.php`: Value object representing an event/message.
- `src/Aluno.php`: Example domain entity that listens for updates.
- `src/NameChanger.php`: Example service that handles data and publishes updates.
- `src/ChangeNameDTO.php`: Data structure for name change requests.
- `index.php`: The entry point simulating a request lifecycle.

## 🚀 How to Run

### Prerequisites
- PHP 7.4 or higher.
- Composer.

### Steps

1.  **Install dependencies**:
    ```bash
    composer install
    ```

2.  **Create/Run Composer Script**:
    To simplify running the built-in server, we can add a script to `composer.json`. This project already includes:
    ```json
    "scripts": {
        "dev": "php -S localhost:8000 index.php"
    }
    ```
    
    To start the server, simply run:
    ```bash
    composer dev
    ```

3.  **Test the Implementation**:
    Open your browser or use `curl` to send a request that triggers the flow.
    
    The `index.php` expects specific query parameters:
    - `controller`: The key defined in the `$controllers` map (e.g., `updateName`).
    - `action`: (Used for routing logic).
    - `data`: A string representing the payload (custom parsing logic in `NameChanger`).

    **Example URL**:
    ```text
    http://localhost:8000/?controller=updateName&action=doChange&data=[alunoId=>1,name=>New Student Name]
    ```

    **Expected Output**:
    1. The `NameChanger` receives the request.
    2. A `Message` is published to `Aluno.update`.
    3. The `MessageBus` dispatches the message.
    4. The `Aluno` instance (subscriber) receives the event and updates its name.
    5. The script outputs a `var_dump` of the `Aluno` object showing the updated name.

## 🛠 Future Improvements

- Decouple `Aluno` from the static `MessageBus` singleton (Dependency Injection).
- Improve the raw string parsing in `NameChanger` to standard JSON handling.
- specific Event classes instead of a generic `Message` class.
