import Repository from './Repository';

class StudentsRepository extends Repository {
  constructor () {
    super('/students')
  }
}

export default new StudentsRepository();
