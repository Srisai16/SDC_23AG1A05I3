import React from 'react';
import TodoItem from './TodoItem';

const TodoList = ({ todos, toggleComplete, removeTodo }) => (
  <>
    {todos.map((todo, index) => (
      <TodoItem
        key={index}
        index={index}
        todo={todo}
        toggleComplete={toggleComplete}
        removeTodo={removeTodo}
      />
    ))}
  </>
);

export default TodoList;
