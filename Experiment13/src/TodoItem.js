const TodoItem = ({ todo, index, toggleComplete, removeTodo }) => (
    <div className={`todo ${todo.completed ? 'completed' : ''}`}>
      <span>{todo.text}</span>
      <div>
        <button onClick={() => toggleComplete(index)}>✔️</button>
        <button onClick={() => removeTodo(index)}>❌</button>
      </div>
    </div>
  );
  