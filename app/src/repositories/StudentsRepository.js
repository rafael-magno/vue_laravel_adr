import Repository from './Repository'

class StudentsRepository extends Repository {
  constructor() {
    super('/students')
  }

  dataFormat(student) {
    student.shift_id = student.shift.id
    student.shift_name = student.shift.name
    student.subjects_id = student.subjects.map(subject => subject.id)

    return student
  }
}

export default new StudentsRepository()
