import { userStore } from "@/store/authPinia";
import { storeNiveles } from '@/store/niveles';

export default function useNiveles() {
    const user = userStore().user

    const niveles = storeNiveles().niveles

    const hasNextLevel = () => {
        // Obtenemos la experiencia del usuario
        const experienciaUsuario = user.experience;

        // Utilizamos el método some() para verificar si hay algún nivel
        // para el cual la experiencia del usuario sea mayor o igual a la experiencia necesaria
        if (niveles.some(nivel => experienciaUsuario >= nivel.experiencia)) {

            // Utilizamos el método find() para encontrar el primer nivel
            // para el cual la experiencia del usuario sea mayor o igual a la experiencia necesaria
            const nextLevel = niveles.find(nivel => experienciaUsuario < nivel.experiencia);

            // Si se encuentra un nivel más alto, lo devolvemos
            return nextLevel ? nextLevel : "Level max";
        }



    }

    return {
        hasNextLevel,
    }
}