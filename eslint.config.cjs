const globals = {
  Alpine: 'readonly',
  Swiper: 'readonly',
  Flowbite: 'readonly',
  window: 'readonly',
  document: 'readonly',
  console: 'readonly',
  module: 'readonly',
  require: 'readonly',
  process: 'readonly',
};

/** @type {import('eslint').Linter.Config[]} */
module.exports = [
  {
    files: ['resources/js/**/*.js'],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals,
    },
    rules: {
      'no-unused-vars': 'warn',
      'no-console': 'warn',
      'prefer-const': 'error',
      'no-var': 'error',
      'object-shorthand': 'error',
      'prefer-template': 'error',
    },
  },
];
