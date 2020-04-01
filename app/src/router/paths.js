/**
 * Define all of your application routes here
 * for more information on routes, see the
 * official documentation https://router.vuejs.org/en/
 */
export default [
  {
    path: '',
    view: 'Form'
  },
  {
    path: '/shifts',
    view: 'Shifts/ShiftsList'
  },
  {
    path: '/shifts/new',
    view: 'Shifts/ShiftsForm'
  },
  {
    path: '/shifts/edit/:id',
    view: 'Shifts/ShiftsForm'
  },
  {
    path: '/subjects',
    view: 'Subjects/SubjectsList'
  },
  {
    path: '/subjects/new',
    view: 'Subjects/SubjectsForm'
  },
  {
    path: '/subjects/edit/:id',
    view: 'Subjects/SubjectsForm'
  },
  {
    path: '/students',
    view: 'Students/StudentsList'
  },
  {
    path: '/students/new',
    view: 'Students/StudentsForm'
  },
  {
    path: '/students/edit/:id',
    view: 'Students/StudentsForm'
  }
]
